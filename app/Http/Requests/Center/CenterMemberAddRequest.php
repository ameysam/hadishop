<?php

namespace App\Http\Requests\Center;

use App\Models\Center;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class CenterMemberAddRequest extends FormRequest
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
        $center_id = Router::getParam('cid');

        $current_user = Auth::user();

        $centers = Center::query();
        if(! $current_user->isSuperAdmin())
        {
            $centers->whereHas('roles', function($query) use ($current_user){
                $query->whereIn('id', $current_user->rolesIDs());
            });
        }
        $centers = $centers->pluck('id')->toArray();

        // $centers = [1];
        // dd($centers);

        return [
            'members' => 'required|array',
            'members.*' => 'required|exists:users,id',
            'roles_id' => 'required|array',
            'roles_id.*' => [
                'required',
                Rule::exists('roles', 'id')->where(function ($query) use ($centers, $current_user) {
                    if(! $current_user->isSuperAdmin())
                    {
                        $query->whereIn('center_id', $centers);
                    }
                }),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'members' => 'اعضا',
            'members.*' => 'اعضا',
            'roles_id' => 'نقش(ها)',
            'roles_id.*' => 'نقش(ها)',
        ];
    }
}
