<?php


namespace App\Traits\Product;


/**
 * Trait ProductAccessorTrait
 */
trait ProductAccessorTrait
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

    public function getSpecialFaAttribute()
    {
        $value = 'معمولی';
        if($this->special === 1)
        {
            $value = 'ویژه';
        }
        return $value;
    }

    public function getSuggestFaAttribute()
    {
        $value = '';
        if($this->suggest === 1)
        {
            $value = 'پیشنهاد شده';
        }
        return $value;
    }
}
