<?php


namespace App\Traits\Category;

trait CategoryAccessorTrait
{
    public function getFileAttribute()
    {
        $result = null;
        if(!empty($this->files[0]))
        {
            $result = $this->files[0];
        }

        return $result;
    }

    public function getFilePathAttribute()
    {
        $result = null;
        if($this->file)
        {
            $result = asset('/' . config('filesystems.files_link') . "/{$this->file->uploaded_name}");
        }
        return $result;
    }
}
