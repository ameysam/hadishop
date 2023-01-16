<?php

namespace App\Http\Controllers\Comment\Admin;

use App\Constants\Types\File\FileReasonType;
use App\Constants\Types\File\FileVisibilityType;
use App\Events\Comment\RegisterCommentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\Comment\CommentSaveService;
use App\Services\File\Src\FileSaveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, CommentSaveService $commentSaveService, FileSaveService $fileSaveService)
    {
        $currentUser = $this->currentUser();

        $record = $this->getRecord($request);

        if(! $record)
        {
            abort(404);
        }

        return DB::transaction(function () use($commentSaveService, $currentUser, $record, $request, $fileSaveService) {
            $comment = $commentSaveService
                ->setUser($currentUser)
                ->setCenter($record->center)
                ->setModel($record)
                ->setContnet(nl2br($request['content']))
                ->save();

            RegisterCommentEvent::dispatch($comment);

                # Upload append files.
            if($request->hasFile('files'))
            {
                $files = $request->file('files');

                $fileSaveService
                    ->setDestination('public')
                    ->setFileableRecord($comment)
                    ->setUser($currentUser)
                    ->setUploader($currentUser)
                    ->setReasonType(FileReasonType::FILE_REASON_COMMENT)
                    ->setVisibilityType(FileVisibilityType::FILE_VISIBILITY_CENTERAL)
                    ->save($files);
            }

            return new SuccessResponse();
        });
    }

    private function getRecord(Request $request)
    {
        $name = Str::ucfirst($request['record_name']);

        $model = "\\App\\Models\\{$name}";

        return $model::getRecord($request['record_id']);
    }
}
