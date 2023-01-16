<?php

namespace App\Services\Event;

use App\Exceptions\MeetingPeriodicConflictException;
use App\Models\Center;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Meeting;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventSaveService
{
    private $user;

    private $center;

    private $room;

    private $request;

    private $record;

    private $scenario = 'store';

    private $saved_ids = [];

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setRoomAndCenter(?Room $room)
    {
        if($room)
        {
            $this->room = $room;
            $this->center = $room->center;
        }
        return $this;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function setRecord(Event $record)
    {
        $this->record = $record;
        return $this;
    }

    public function setScenario(string $scenario)
    {
        $this->scenario = $scenario;
        return $this;
    }

    public function getRecord()
    {
        return $this->record;
    }

    public function run()
    {
        // Make first record
        $record = $this->save($this->request, $this->record, null, 0);
        $this->saved_ids[] = $record->id;

        $periodic_step_count = $this->request['step_count'];
        $this->record = $record;

        if($this->scenario == 'store' && $record->isPeriodic())
        {
            for($i = 1; $i <= $periodic_step_count; $i++)
            {
                $record = $this->save($record, null, $record, $i);
                $this->saved_ids[] = $record->id;
            }
        }

        if($this->scenario == 'store')
        {
            $this->afterSave();
        }


        return $this->record;
    }


    private function afterSave()
    {
        $events = Event::whereIn('id', $this->saved_ids)->wherePeriodic()->get();
        foreach($events as $event)
        {
            $event->name = "{$event->name}_شماره_{$event->periodic_count}";
            $event->save();
        }
    }

    private function save($data, $record = null, $referece_record = null, $periodic_count = null)
    {
        $newRecord = $record;
        if($newRecord == null)
        {
            $newRecord = new Event();
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
        $newRecord->center_id = $this->center->id ?? null;
        $newRecord->room_id = $this->room->id ?? null;
        $newRecord->name = $data['name'];
        $newRecord->color = $data['color'] ?? '#dc3545';
        $newRecord->day = $day;
        $newRecord->started_time = $data['started_time'];
        $newRecord->finished_time = $data['finished_time'];
        $newRecord->started_at = "{$day} {$data['started_time']}";
        if($data['finished_time'])
        {
            $newRecord->finished_at = "{$day} {$data['finished_time']}";
        }
        $newRecord->description = $data['description'];

        if($this->scenario == 'store')
        {
            $newRecord->periodic_type = $data['periodic_type'];

            if($periodic_count != null)
            {
                $newRecord->periodic_count = $periodic_count+1;
            }
        }

        $newRecord->save();


        // Sync users
        $newRecord->users()->sync($this->getUsersIDs($data, $newRecord)['exists_users']);
        // $newRecord->()->sync($this->getUsersIDs($data));

        // // Sync roles
        // $newRecord->roles()->sync($this->getRolesIDs($data));

        return $newRecord;
    }


    private function getUsersIDs($data, $newRecord)
    {
        if($data instanceof Event)
        {
            $data['users'] = $data->users()->pluck('users.id')->toArray();
        }

        $users_ids = $data['users'] ?? [];
        $users_ids[] = $this->user->id;

        $users = collect($users_ids);

        $exists_users = collect([]);
        $new_users = collect([]);

        Guest::where('guestable_id', $newRecord->id)->where('guestable_type', Event::class)->delete();

        $users->map(function($user) use (&$exists_users, &$new_users, $newRecord){
            if(is_numeric($user) && User::where('id', $user)->exists())
            {
                if(!$exists_users->contains($user))
                {
                    $exists_users->push($user);
                }
            }
            else if(is_string($user))
            {
                $names = explode(' ',$user);

                $tmp_user = Guest::create([
                    'first_name' => $names[0] ?? '',
                    'last_name' => $names[1] ?? '',
                    'guestable_id' => $newRecord->id,
                    'guestable_type' => Event::class,
                ]);
                $new_users->push($tmp_user->id);
            }
        });

        $exists_users = $exists_users->toArray();
        $new_users = $new_users->toArray();

        return [
            'exists_users' => array_unique($exists_users),
            'new_users' => array_unique($new_users),
        ];


        $users_ids = array_unique($users_ids);
        return $users_ids;
    }

    private function getRolesIDs($data)
    {
        if($data instanceof Event)
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
