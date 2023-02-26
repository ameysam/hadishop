<?php
namespace App\Traits\Product;

use Illuminate\Support\Str;
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

    public function isSuggest()
    {
        return $this->suggest === 1;
    }

    public function isAvailable()
    {
        return $this->available === 1;
    }

    public function urlShow()
    {
        return route('front.product.show', [$this->id, Str::replaceSpace($this->name, '-')]);
    }

    public static function urlIndex()
    {
        return route('front.product.index');
    }
}
