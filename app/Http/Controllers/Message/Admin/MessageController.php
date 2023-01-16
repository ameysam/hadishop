<?php

namespace App\Http\Controllers\Message\Admin;

use App\Constants\Types\MessageUser\MessageUserStatusType;
use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\MessageUser;
use App\Services\Message\MessageFetchService;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index(MessageFetchService $messageFetchService)
    {
        $currentUser = $this->currentUser();

        $messages = $messageFetchService
            ->whereReceivers([$currentUser->id])
            ->prepareQuery()
            ->latest()
            ->with([
                'users' => function($query) use ($currentUser){
                    $query->where('user_id', $currentUser->id);
                }
                ])
            ->paginate(12);

        foreach($messages as $message)
        {
            $message->is_seen = $message->users[0]->pivot->status == MessageUserStatusType::MESSAGE_USER_STATUS_SEEN;
            $message->seen_status_fa = $message->is_seen ? null : 'جدید';
        }

        $data = [
            'records' => $messages,
        ];

        $this->breadcrumb();

        return view('messages.admin.index', $data);
    }



    public function show($id, MessageFetchService $messageFetchService)
    {
        $currentUser = $this->currentUser();

        $message = $messageFetchService
            ->whereReceivers([$currentUser->id])
            ->prepareQuery()
            ->with([
                'users' => function($query) use ($currentUser){
                    $query->where('user_id', $currentUser->id);
                },
                'sender:id,first_name,last_name'
                ])
            ->findOrFail($id);

        $message->user = $message->users[0] ?? null;
        $message->is_seen = $message->users[0]->pivot->status == MessageUserStatusType::MESSAGE_USER_STATUS_SEEN;
        $message->seen_status_fa = $message->is_seen ? null : 'جدید';
        $message->created_at_farsi = $message->created_at_fa;

        MessageUser::whereUser([$currentUser->id])->where('message_id', $id)->update(['status' => MessageUserStatusType::MESSAGE_USER_STATUS_SEEN]);

        $_unseen_messages_count = $messageFetchService
                ->whereReceivers([$currentUser->id])
                ->whereUnseen()
                ->prepareQuery()
                ->count();

        $data = [
            'record' => $message,
            'unseen_messages_count' => $_unseen_messages_count,
        ];

        return new SuccessResponse('status', null, $data);
    }


    private function breadcrumb()
    {
        $breadcrumb = [
            [
                'title' => 'پیام‌ها',
                'link' => route('admin.message.index'),
            ],
        ];
        $this->setBreadcrumb($breadcrumb);
    }
}
