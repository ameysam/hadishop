<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|string|max:65000',
            'files' => 'nullable|array|max:5',
            'files.*' => 'mimes:jpeg,png,wav,mp3,doc,docx,xls,xlsx,pdf',
            'record_id' => 'required|numeric',
            'record_name' => 'required|in:event,meeting',
        ];
    }

    public function withValidator($validator)
    {
        $request = request();

        $validator->after(function ($validator) use ($request) {

            $files = $request->file('files');

            if($files)
            {
                $images_files_size = 0;
                $texts_files_size = 0;
                $audios_files_size = 0;

                foreach($files as $file)
                {
                    $type = $this->getType($file);
                    $size = number_format($file->getSize() / 1048576,2);

                    if($type == 'image')
                    {
                        $images_files_size += $size;
                    }
                    else if($type == 'text')
                    {
                        $texts_files_size += $size;
                    }
                    else if($type == 'audio')
                    {
                        $audios_files_size += $size;
                    }
                }

                if($images_files_size > 10)
                {
                    $validator->errors()->add('files', "حجم فایل های تصویر شما {$images_files_size} مگابایت است و حداکثر تا 10 مگابایت مجاز است.");
                }
                if($texts_files_size > 1)
                {
                    $validator->errors()->add('files', "حجم فایل های متنی شما {$texts_files_size} مگابایت است و حداکثر تا 10 مگابایت مجاز است.");
                }
                if($audios_files_size > 50)
                {
                    $validator->errors()->add('files', "حجم فایل های صوتی شما {$audios_files_size} مگابایت است و حداکثر تا 50 مگابایت مجاز است.");
                }
            }
        });
    }

    private function getType($file)
    {
        $mime = $file->getClientMimeType();
        if(in_array($mime, ['image/jpeg', 'image/png']))
        {
            $type = 'image';
        }
        else if(in_array($mime, ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingm', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']))
        {
            $type = 'text';
        }
        else if(in_array($mime, ['audio/mpeg', 'audio/wave']))
        {
            $type = 'audio';
        }

        return $type;
    }



    public function messages()
    {
        return [
            'content.max' => "طول متن «:attribute» بیش از حد مجاز است.",
            'record_id.required' => 'مورد «:attribute» درست نیست.',
            'record_name.in' => 'مورد «:attribute» درست نیست.',
        ];
    }

    public function attributes()
    {
        return [
            'content' => 'متن پیام',
            'record_name' => 'نام رکورد',
            'record_id' => 'شماره رکورد',
        ];
    }
}
