<?php

namespace App\Listeners\Meeting;

use App\Events\Meeting\RegisterMeetingEvent;
use App\Services\Sms\Contracts\Sms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendSMSNotificationToMeetingUsersListener
{
    private $sms;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Handle the event.
     *
     * @param  RegisterMeetingEvent  $event
     * @return void
     */
    public function handle(RegisterMeetingEvent $event)
    {
        $meeting = $event->meeting;

        $users = $meeting->getAllUsers();

        $mobile_numbers = [];
        $messages = [];
        $appName = config('app.name');

        $meeting_started_day = Str::numberFa(jdate($meeting->started_at)->format('%A مورخ Y/m/d'));
        $meeting_started_time = Str::numberFa(jdate($meeting->started_at)->format('H:i'));

        if($event->scenario == 'canceled')
        {
            $meesage = [
                "جلسه «{$meeting->name}» که در ساعت {$meeting_started_time} روز {$meeting_started_day} تشکیل می‌شد لغو شد.",
                "لینک جلسه: " . route('admin.meeting.view', $meeting->id),
                $appName
            ];
        }
        else if($event->scenario == 'activated')
        {
            $meesage = [
                "جلسه «{$meeting->name}» که در ساعت {$meeting_started_time} روز {$meeting_started_day} تشکیل می‌شد و لغو شده بود، مجددا تشکیل می‌شود.",
                "لینک جلسه: " . route('admin.meeting.view', $meeting->id),
                $appName
            ];
        }
        else
        {
            $meesage = [
                "شما به جلسه «{$meeting->name}» که در ساعت {$meeting_started_time} روز {$meeting_started_day} تشکیل می‌شود دعوت شده‌اید.",
                "لینک جلسه: " . route('admin.meeting.view', $meeting->id),
                $appName
            ];
        }
        

        

        $meesage = implode("\n", $meesage);

        $users->map(function($user) use (&$mobile_numbers, &$messages, $meesage) {
            $mobile_numbers[] = $user->mobile_no;
            $messages[] = $meesage;
        });

        $result = $this->sms->sendArray($mobile_numbers, $messages);

        // Log::debug('users:' . json_encode($mobile_numbers) . json_encode($messages) . "\n");
        Log::channel('sms')->info('result:' . $result);
    }
}
