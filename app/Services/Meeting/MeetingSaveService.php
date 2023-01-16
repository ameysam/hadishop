<?php

namespace App\Services\Meeting;

use App\Exceptions\MeetingPeriodicConflictException;
use App\Models\Center;
use App\Models\Meeting;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingSaveService
{
    private $user;

    private $secretary;

    private $center;

    private $room;

    private $request;

    private $record;

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setSecretary(User $user = null)
    {
        $this->secretary = $user;
        return $this;
    }

    public function setCenter(Center $center = null)
    {
        $this->center = $center;
        return $this;
    }

    public function setRoom(Room $room)
    {
        $this->room = $room;
        return $this;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function setRecord(Meeting $record)
    {
        $this->record = $record;
        return $this;
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function run()
    {
        $deletables = [];
        $errors = [];

        // Make first record
        $record = $this->save($this->request, $this->record);
        $this->record = $record;

        $old_record_id = $record->id;

        if($record->isPeriodic())
        {
            $schedule = $this->room->schedule;

            // dd($record);

            $schedule_finished_at = Carbon::parse("{$schedule->finished_date} {$schedule->finished_time}");
            // dd($schedule, $schedule_finished_at);

            $periodic_days = $record->periodic_type;
            $loop_step = 0;


            // dd($record_finished_at);
            while(true)
            {
                $record = $this->save($record, null, $record);
                $old_record_id = $record->id;

                $record_started_at = Carbon::parse($record->started_at);
                $record_finished_at = Carbon::parse($record->finished_at);

                // if($loop_step > 0)
                // {
                //     $record_started_at->addDays($periodic_days);
                //     $record_finished_at->addDays($periodic_days);
                // }

                if($schedule_finished_at->gt($record_finished_at))
                {
                    // اگر روز مورد نظر در روزهای این زمانبندی موجود باشد
                    if($schedule->details()->where('started_at', '<=', $record_started_at)->where('finished_at', '>=', $record_finished_at)->exists())
                    {
                        $meetings = Meeting::whereCenter($this->center)
                            ->whereRoom($this->room)
                            ->whereActive()
                            ->where('day', $record_started_at->format('Y-m-d'))
                            ->where('id', '!=', $record->id)
                            ->get();

                        if($meetings->count())
                        {
                            foreach($meetings as $item)
                            {
                                $tmp_started_time = Carbon::parse($item->started_at);
                                $tmp_started_time_minus_gap = (Carbon::parse($item->started_at))->addMinutes(-$schedule->gap_duration);

                                $tmp_finished_time = (Carbon::parse($item->finished_at));
                                $tmp_finished_time_plus_gap = (Carbon::parse($item->finished_at))->addMinutes($schedule->gap_duration);

                                if($record_started_at->gte($tmp_started_time) && $record_started_at->lt($tmp_finished_time_plus_gap))
                                {
                                    $errors[] = $this->makeMessage($record_started_at, $record_finished_at, "با سایر جلسات دارای تداخل است.");
                                    if($old_record_id)
                                    {
                                        $deletables[] = $old_record_id;
                                    }
                                    $loop_step++;
                                    continue;
                                }
                                else if($record_finished_at->gt($tmp_started_time_minus_gap) && $record_finished_at->lte($tmp_finished_time))
                                {
                                    $errors[] = $this->makeMessage($record_started_at, $record_finished_at, "با سایر جلسات دارای تداخل است.");
                                    if($old_record_id)
                                    {
                                        $deletables[] = $old_record_id;
                                    }
                                    $loop_step++;
                                    continue;
                                }
                                else if($record_started_at->lte($tmp_started_time_minus_gap) && $record_finished_at->gte($tmp_finished_time_plus_gap))
                                {
                                    $errors[] = $this->makeMessage($record_started_at, $record_finished_at, "با سایر جلسات دارای تداخل است.");
                                    if($old_record_id)
                                    {
                                        $deletables[] = $old_record_id;
                                    }
                                    $loop_step++;
                                    continue;
                                }
                            }
                        }
                        // اینجا میشه رکورد جدید اضافه کرد

                        $loop_step++;
                        continue;
                    }
                    else
                    {
                        $errors[] = $this->makeMessage($record_started_at, $record_finished_at, "در زمانبندی‌های این اتاق موجود نیست.");
                        if($old_record_id)
                        {
                            $deletables[] = $old_record_id;
                        }
                        $loop_step++;
                        continue;
                    }
                }
                else if($loop_step == 0)
                {
                    // $errors[] = $this->makeMessage($record_started_at, $record_finished_at, "آخرین روز زمانبندی این اتاق است.");
                    if($old_record_id)
                    {
                        $deletables[] = $old_record_id;
                    }
                    if($loop_step > 0)
                    {
                        break;
                    }
                    $loop_step++;
                    continue;
                }
                else
                {
                    if($old_record_id)
                    {
                        $deletables[] = $old_record_id;
                    }
                    if($loop_step > 0)
                    {
                        break;
                    }
                    $loop_step++;
                    continue;
                }
            }
        }

        if(count($errors) && $this->request['force_save'] != '1')
        {
            throw new MeetingPeriodicConflictException(implode(',', $errors));
        }

        // if($this->request['force_save'] == '1')
        if(count($deletables))
        {
            Meeting::whereIn('id', $deletables)->forceDelete();
        }

        if($this->record)
        {
            $allMeetings = Meeting::where('periodic_reference_id', $this->record->id)->get();
            $loop_count = 1;
            foreach($allMeetings as $meeting_item)
            {
                $meeting_item->name = "{$meeting_item->name}-{$loop_count}";
                $meeting_item->periodic_count = ++$loop_count;
                $meeting_item->save();
            }
        }

        return $record;
    }


    private function save($data, $record = null, $referece_record = null)
    {
        $newRecord = $record;
        if($newRecord == null)
        {
            $newRecord = new Meeting();
        }

        $day = $data['day'];
        if($referece_record)
        {
            $day = Carbon::parse($data['day'])->addDays($referece_record->periodic_type)->format('Y-m-d');
            if($this->record)
            {
                $newRecord->periodic_reference_id = $this->record->id;
            }
        }
        $newRecord->user_id = $this->user->id;
        $newRecord->center_id = $this->center->id;
        $newRecord->room_id = $this->room->id;
        $newRecord->secretary_id = $this->secretary->id ?? null;
        $newRecord->name = $data['name'];
        $newRecord->description = $data['description'];
        $newRecord->day = $day;
        $newRecord->started_time = $data['started_time'];
        $newRecord->finished_time = $data['finished_time'];
        $newRecord->started_at = "{$day} {$data['started_time']}";
        $newRecord->finished_at = "{$day} {$data['finished_time']}";
        $newRecord->color = $data['color'];
        $newRecord->periodic_type = $data['periodic_type'];
        $newRecord->save();

        // Sync users
        $newRecord->users()->sync($this->getUsersIDs($data));

        // Sync roles
        $newRecord->roles()->sync($this->getRolesIDs($data));

        return $newRecord;
    }


    private function getUsersIDs($data)
    {
        if($data instanceof Meeting)
        {
            $data['users'] = $data->users()->pluck('users.id')->toArray();
        }

        $users_ids = $data['users'] ?? [];

        $users_ids[] = $this->user->id;

        if($this->secretary)
        {
            $users_ids[] = $this->secretary->id;
        }

        $users_ids = array_unique($users_ids);
        return $users_ids;
    }

    private function getRolesIDs($data)
    {
        if($data instanceof Meeting)
        {
            $data['roles'] = $data->roles()->pluck('roles.id')->toArray();
        }
        $roles_ids = $data['roles'] ?? [];
        return $roles_ids;
    }

    private function makeMessage($first_date, $last_date, $message)
    {
        $first_date_fa = jdate($first_date)->format('Y/m/d');
        return "روز {$first_date_fa} از ساعت {$first_date->format('H:i')} تا {$last_date->format('H:i')} {$message}";
    }
}
