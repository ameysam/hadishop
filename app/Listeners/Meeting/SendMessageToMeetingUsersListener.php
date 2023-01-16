<?php

namespace App\Listeners\Meeting;

use App\Events\Meeting\RegisterMeetingEvent;
use App\Services\Message\MessageSendService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendMessageToMeetingUsersListener
{

    private $messageSendService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MessageSendService $messageSendService)
    {
        $this->messageSendService = $messageSendService;
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

        $users_ids = $meeting->getAllUsersIDs();

        $date = Str::numberFa(jdate($meeting->started_at)->format('Y/m/d'));
        $time = Str::numberFa(jdate($meeting->started_at)->format('H:i'));

        if($event->scenario == 'store')
        {
            $messageTitle = "رزرو جلسه {$meeting->name}";
            $messageContent = "جلسه «{$meeting->name}» در ساعت «{$time}» و تاریخ «{$date}» برای شما ثبت شد.";
        }
        else if($event->scenario == 'update')
        {
            $messageTitle = "بروزرسانی جلسه {$meeting->name}";
            $messageContent = "جلسه «{$meeting->name}» به ساعت «{$time}» در تاریخ «{$date}» انتقال پیدا کرد.";
        }
        else if($event->scenario == 'canceled')
        {
            $messageTitle = "لغو جلسه {$meeting->name}";
            $messageContent = "جلسه «{$meeting->name}» که در ساعت «{$time}» و تاریخ «{$date}» تشکیل می‌شد، لغو شد.";
        }
        else if($event->scenario == 'activated')
        {
            $messageTitle = "فعال‌سازی جلسه {$meeting->name}";
            $messageContent = "جلسه «{$meeting->name}» که در ساعت «{$time}» و تاریخ «{$date}» تشکیل می‌شد و لغو شده بود، مجددا تشکیل می‌شود.";
        }
        
        $messageContent .= "<br><br><a target='_blank' class='text-dark text-decoration-underline' href='".route('admin.meeting.view', $meeting->id)."'>مشاهده جلسه</a>";

        $message = $this->messageSendService
            ->setSenderName(config('app.name'))
            ->setTitle($messageTitle)
            ->setContent($messageContent)
            ->setReceivers($users_ids)
            ->setModel($meeting)
            ->send();

        $users_ids = json_encode($users_ids);

        Log::channel('message')->info("MESSAGE , Receivers: $users_ids , Message: {$message}");
    }
}
