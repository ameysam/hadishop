<?php

namespace App\Listeners\Event;

use App\Events\Event\RegisterEventRecordEvent;
use App\Services\Message\MessageSendService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendMessageToEventUsersListener
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
     * @param  RegisterEventRecordEvent  $event
     * @return void
     */
    public function handle(RegisterEventRecordEvent $event)
    {
        $eventRecord = $event->event;

        $users_ids = $eventRecord->getAllUsersIDs();

        $date = Str::numberFa(jdate($eventRecord->started_at)->format('Y/m/d'));
        $time = Str::numberFa(jdate($eventRecord->started_at)->format('H:i'));

        if($event->scenario == 'store')
        {
            $messageTitle = "رزرو رویداد {$eventRecord->name}";
            $messageContent = "رویداد «{$eventRecord->name}» در ساعت «{$time}» و تاریخ «{$date}» برای شما ثبت شد.";
        }
        else if($event->scenario == 'update')
        {
            $messageTitle = "بروزرسانی رویداد {$eventRecord->name}";
            $messageContent = "رویداد «{$eventRecord->name}» به ساعت «{$time}» در تاریخ «{$date}» انتقال پیدا کرد.";
        }
        $messageContent .= "<br><br><a target='_blank' class='text-dark text-decoration-underline' href='".route('admin.event.view', $eventRecord->id)."'>مشاهده رویداد</a>";

        $message = $this->messageSendService
            ->setSenderName(config('app.name'))
            ->setTitle($messageTitle)
            ->setContent($messageContent)
            ->setReceivers($users_ids)
            ->setModel($eventRecord)
            ->send();

        $users_ids = json_encode($users_ids);

        Log::channel('message')->info("MESSAGE , Receivers: $users_ids , Message: {$message}");
    }
}
