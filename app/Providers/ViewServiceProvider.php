<?php

namespace App\Providers;

use App\Http\View\Composers\ComponentProvincesComposer;
use App\Http\View\Composers\GenderSelectorsComposer;
use App\Http\View\Composers\GlobalCenterRecordComposer;
use App\Http\View\Composers\GlobalVariablesComposer;
use App\Http\View\Composers\RoleAssignAdminComposer;
use App\Http\View\Composers\SidebarMenuComposer;
use App\Models\Center;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', GlobalVariablesComposer::class);
        View::composer('_layouts.admin.includes.sidebar', SidebarMenuComposer::class);
        View::composer('centers.*', GlobalCenterRecordComposer::class);
        View::composer('_components.admin.select.province_cities', ComponentProvincesComposer::class);
        View::composer('_components.admin.select.radio_gender', GenderSelectorsComposer::class);
        View::composer('_components.admin.modal.role-assign-admin-modal', RoleAssignAdminComposer::class);

        Blade::directive('script', function ($expression) {
            return "<?php \$__env->startPush('script_lib'); ?>
                    <script src=\"<?php echo e(asset(\"assets/{$expression}\")); ?>\"></script>
                    <?php \$__env->stopPush(); ?>";
        });

        Blade::directive('style', function ($expression) {
            return "<?php \$__env->startPush('style_lib'); ?>
                    <link rel=\"stylesheet\" href=\"<?php echo e(asset(\"assets/{$expression}\")); ?>\"></script>
                    <?php \$__env->stopPush(); ?>";
        });

        Blade::if('hasp', function ($permission, $center) {
            $conditon = false;
            $user = Auth::user();

            // check if the user is authenticated
            if ($user)
            {
                if($user->isSuperAdmin())
                {
                    return true;
                }

                if($center instanceof Center)
                {
                    $center = $center->id;
                }
                else
                {
                    $center = (int)$center;
                    if(!is_int($center))
                    {
                        throw new Exception("Invalid center id.");
                    }
                }

                // check if the user has the permission
                $condition = $user->hasp($permission, $center);
            }

            return $condition;
        });

        Blade::if('hasap', function ($permissions, $center) {
            $conditon = false;
            $user = Auth::user();

            // check if the user is authenticated
            if ($user)
            {
                if($user->isSuperAdmin())
                {
                    return true;
                }

                if($center instanceof Center)
                {
                    $center = $center->id;
                }
                else
                {
                    $center = (int)$center;
                    if(!is_int($center))
                    {
                        throw new Exception("Invalid center id.");
                    }
                }

                if(! is_array($permissions))
                {
                    $permissions = [$permissions];
                }

                foreach ($permissions as $permission)
                {
                    if ($user->hasp($permission, $center))
                    {
                        $condition = true;
                    }
                }

                // $condition = false;
            }

            return $condition;
        });
    }
}
