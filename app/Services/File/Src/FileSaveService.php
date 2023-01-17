<?php

namespace App\Services\File\Src;

use App\Models\Center;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class FileSaveService
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $disk;

    /**
     * @var string
     */
    private $destination;

    /**
     * @var User
     */
    private $user;

    /**
     * @var User
     */
    private $uploader;

    /**
     * @var Center
     */
    private $center;

    /**
     * @var int
     */
    private $package_count;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var int
     */
    private $visibility_type;

    /**
     * @var int
     */
    private $reason_type;

    /**
     * @var string
     */
    private $fileable_type;

    /**
     * @var int
     */
    private $fileable_id;

    /**
     * @var EloquentModel
     */
    private $fileable_record;


    public function __construct()
    {
        $this->setDisk(config('filesystems.default')); // Default is local
    }

    public function setUploader(User $uploader)
    {
        $this->uploader = $uploader;

        return $this;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function setName(string $value)
    {
        $this->name = $value;

        return $this;
    }

    public function setDisk(string $value)
    {
        $this->disk = $value;

        return $this;
    }

    public function setDestination(string $value)
    {
        $this->destination = $value;

        return $this;
    }

    public function setCenter(Center $object)
    {
        $this->center = $object;

        return $this;
    }

    public function setReasonType(int $value)
    {
        $this->reason_type = $value;

        return $this;
    }

    public function setVisibilityType(int $value)
    {
        $this->visibility_type = $value;

        return $this;
    }

    public function setFileableRecord(EloquentModel $record)
    {
        $this->fileable_record = $record;

        $this->setFileableType(get_class($this->fileable_record));

        $this->setFileableId($this->fileable_record->id);

        return $this;
    }

    public function setFileableType(string $value)
    {
        $this->fileable_type = $value;

        return $this;
    }

    public function setFileableId(int $value)
    {
        $this->fileable_id = $value;

        return $this;
    }

    public function save($files)
    {
        // $this->current_user = Auth::user();

        $destination = $this->destination;

        if(! is_array($files))
        {
            $files = [$files];
        }

        if(!$this->name)
        {
            $this->name = Str::random(10) . time() . Str::random(10);
        }

        $fileable_type = $this->fileable_type ?? null;
        $fileable_id = $this->fileable_id ?? null;
        $now = now();
        $records = [];

        $this->package_count = count($files);

        foreach($files as $key => $file)
        {
            $key = str_pad($key+1, 2, "0", STR_PAD_LEFT);

            if(gettype($file) == "string") # If file is base64 string
            {
                $mime_type = FileManageService::getMimeFromStream($file);
                $file_type = FileManageService::getFileTypeByMime($mime_type);
                $extension = FileManageService::getExtensionByMime($mime_type);

                $original_name = 'base64';

                $filename = "{$this->name}{$key}.{$extension}";

                Storage::disk($this->disk)->put("{$destination}/{$filename}", $file);

                $file_path = "{$destination}/{$filename}";
            }
            else
            {
                $mime_type = $file->getMimeType();
                $file_type = FileManageService::getFileTypeByMime($mime_type);
                $extension = $file->getClientOriginalExtension();
                $original_name = $file->getClientOriginalName();

                $filename = "{$this->name}{$key}.{$extension}";

                $file_path = Storage::disk($this->disk)->putFileAs($destination, $file, $filename);
            }


            $records[] = [
                'user_id' => $this->user->id,
                'uploader_id' => $this->uploader->id ?? $this->user->id,
                'origin_name' => $original_name,
                'uploaded_name' => $filename,
                'type_name' => $mime_type,
                'type' => $file_type,
                'extension' => $extension,
                'full_path' => storage_path($file_path),
                'path' => ("app/{$file_path}"),
                'fileable_type' => $fileable_type,
                'fileable_id' => $fileable_id,
                'visibility_type' => $this->visibility_type,
                'reason_type' => $this->reason_type,
                'package_count' => $this->package_count,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        $result_records = File::insert($records);

        if($result_records !== true)
        {
            foreach($records as $record)
            {
                unlink(storage_path("{$record['path']}"));
            }
        }

        return $records;
    }
}
