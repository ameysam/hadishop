<?php

namespace App\Console\Commands;

use App\Constants\Types\Meeting\MeetingHoldingStatusType;
use App\Models\Meeting;
use Illuminate\Console\Command;

class MeetingHoldingStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meeting:holding_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $records = Meeting::whereActive()->whereWillBeExpired()->update([
            'holding_status' => MeetingHoldingStatusType::MEETING_HOLDING_STATUS_TERMINATED,
        ]);
    }
}
