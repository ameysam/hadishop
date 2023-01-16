<?php

namespace App\Http\View\Composers;

use App\Constants\Types\User\UserGenderType;
use Illuminate\View\View;

class GenderSelectorsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View  $view
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function compose(View $view)
    {
        $genders = UserGenderType::getValues();
        $view->with('_genders', $genders);
    }
}
