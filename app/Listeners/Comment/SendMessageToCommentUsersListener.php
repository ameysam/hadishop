<?php

namespace App\Listeners\Comment;

use App\Events\Comment\RegisterCommentEvent;
use App\Services\Message\MessageSendService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendMessageToCommentUsersListener
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
     * @param  RegisterCommentEvent  $event
     * @return void
     */
    public function handle(RegisterCommentEvent $event)
    {
        $comment = $event->comment;

        $commentable_record = $comment->commentable;

        $users_ids = $commentable_record->getAllUsersIDs();

        $date = Str::numberFa(jdate($comment->started_at)->format('Y/m/d'));
        $time = Str::numberFa(jdate($comment->started_at)->format('H:i'));

        $commentable_record_type = $commentable_record->getSectionName();
        $commentable_record_route = $commentable_record->getRoute();

        $messageTitle = "درج نظر در {$commentable_record_type} «{$commentable_record->name}»";
        $messageContent = "یک نظر جدید در ساعت «{$time}» و تاریخ «{$date}» برای {$commentable_record_type} «{$commentable_record->name}» ثبت شد." . '<br><br>متن نظر:<br><br>';
        $messageContent .= $comment->content;
        $messageContent .= "<br><br><a target='_blank' class='text-dark text-decoration-underline' href='{$commentable_record_route}'>مشاهده {$commentable_record_type}</a>";

        $message = $this->messageSendService
            ->setSenderName(config('app.name'))
            ->setTitle($messageTitle)
            ->setContent($messageContent)
            ->setReceivers($users_ids)
            ->setModel($commentable_record)
            ->send();

        $users_ids = json_encode($users_ids);

        Log::channel('message')->info("COMMENT , Receivers: $users_ids , Message: {$message}");
    }
}
