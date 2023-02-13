<?php

namespace App\Traits\Product;
/**
 * Trait ProductMethodTrait
 * @package App\Traits\Product
 */
trait ProductMethodTrait
{
    public function getImage()
    {
        if(!$this->files->isEmpty())
        {
            return config('filesystems.files_link') . "/{$this->files[0]->uploaded_name}";
        }
        return 'no-image.png';
    }

    public function isSpecial()
    {
        return $this->special === 1;
    }
}
