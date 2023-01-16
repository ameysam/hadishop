<?php

namespace App\Services\File\Src;

use App\Constants\Types\File\FileType;
use Illuminate\Support\Facades\Storage;

class FileManageService
{
    public static function getMimeFromStream($stream)
    {
        $f = finfo_open();
        $result = finfo_buffer($f, $stream, FILEINFO_MIME_TYPE);
        return $result;
    }


    public static function getMimeFromBase64($base64_encoded)
    {
        list(, $data) = explode(';', $base64_encoded);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        return self::getMimeFromStream($data);
    }


    public static function getExtensionByMime(string $mime)
    {
        $mimes = [
            'image/png' => 'png',
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'application/pdf' => 'pdf',
            'text/plain' => 'pdf',
        ];

        return ($mimes[$mime] ?? null);
    }

    public static function getFileTypeByMime(string $mime)
    {
        $types = [
            'image/png' => FileType::FILE_PNG,
            'image/jpeg' => FileType::FILE_JPG,
            'image/jpg' => FileType::FILE_JPG,
            'application/pdf' => FileType::FILE_PDF,
            'text/plain' => FileType::FILE_PLAIN_TEXT,
        ];

        return ($types[$mime] ?? null);
    }


    public static function makeNewFileFromBinary($binary_stream, $type)
    {
        if(in_array($type, ['png', 'jpg', 'jpeg']))
        {
            $type = "image/{$type}";
        }
        return "data:{$type};base64," . base64_encode($binary_stream);
    }


    public static function makeNewFileFromPath($path, $mime = 'application/pdf', $disk = 'local')
    {
        $file = Storage::disk($disk)->get($path);

        $file = self::makeNewFileFromBinary($file, $mime);

        return $file;
    }
}
