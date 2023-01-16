<?php

namespace App\Services\Schedule\Admin;

use App\Constants\Types\Schedule\ScheduleStatusType;
use App\Models\Center;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ScheduleSaveService
{

    private $center;

    private $record;

    private $request;

    public function setCenter(Center $center)
    {
        $this->center = $center;
        return $this;
    }

    public function setRecord(Schedule $record)
    {
        $this->record = $record;
        return $this;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }


    public function getRecord()
    {
        return $this->record;
    }

    public function save()
    {
        $request = $this->request;

        if(!$this->record)
        {
            $this->record = new Schedule();
        }

        list($started_date, $finished_date) = explode(' - ', $request['dates']);

        $this->record->name = $request['name'];

        $this->record->status = $request['status'] ?? ScheduleStatusType::SCHEDULE_STATUS_ACTIVE;

        $this->record->started_date = $started_date;

        $this->record->finished_date = $finished_date;

        $this->record->started_time = "{$request['started_time_hr']}:{$request['started_time_min']}";

        $this->record->finished_time = "{$request['finished_time_hr']}:{$request['finished_time_min']}";

        $this->record->reserve_duration = ($request['reserve_duration_hr'] * 60) + $request['reserve_duration_min'];

        $this->record->gap_duration = ($request['gap_duration_hr'] * 60) + $request['gap_duration_min'];

        $this->record->center_id = $this->center->id;

        $this->record->save();

        return $this;
    }


    public function saveTimes($removeOlder = false)
    {
        $request = $this->request;

        $now = now();

        $starts = $request['times_start'];
        $finishs = $request['times_finish'];
        $times_count = count($starts);

        if($removeOlder)
        {
            ScheduleDetail::where('schedule_id', $this->record->id)->forceDelete();
        }

        for($i = 0; $i < $times_count; $i++)
        {
            ScheduleDetail::create([
                'center_id' => $this->center->id,
                'schedule_id' => $this->record->id,
                'started_at' => $starts[$i],
                'finished_at' => $finishs[$i],
            ]);
        }

        $starts_dis = $request['times_start_dis'];
        $finishs_dis = $request['times_finish_dis'];
        if($starts_dis)
        {
            $times_dis_count = count($starts_dis);

            for($i = 0; $i < $times_dis_count; $i++)
            {
                ScheduleDetail::create([
                    'center_id' => $this->center->id,
                    'schedule_id' => $this->record->id,
                    'started_at' => $starts_dis[$i],
                    'finished_at' => $finishs_dis[$i],
                    'deleted_at' => $now,
                ]);
            }
        }





        // foreach($timeRecords as $timeRecord)
        // {
        //     list($day, $time) = Str::of($timeRecord)->explode(' ');
        //     ScheduleDetail::create([
        //         'center_id' => $this->center->id,
        //         'schedule_id' => $this->record->id,
        //         'day' => $day,
        //         'started_time' => $time,
        //         'finished_time' => $time,
        //     ]);
        // }

        return true;
    }
}
