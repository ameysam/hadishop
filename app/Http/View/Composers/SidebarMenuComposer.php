<?php

namespace App\Http\View\Composers;

use App\Models\Month;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\User\Admin\UserModeService;

class SidebarMenuComposer
{
    private $main_menus = [];


    private $bottom_menus = [];


    /**
     * LayoutAdminComposer constructor.
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct()
    {
    }

    private function mainMenus()
    {
        $menu = [];



        // if($user->isSuperAdmin())
        $menu[] = [
            'title' => "کاربران",
            'permission' => ['user-show'],
            'name' => 'users',
            'icon' => 'fas fa-users',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.user.index'),
        ];

        $menu[] = [
            'title' => "دسته‌بندی‌ها",
            'permission' => ['category-show'],
            'name' => 'category',
            'icon' => 'fas fa-box',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.category.index'),
        ];


        $menu[] = [
            'title' => "کالاها",
            'permission' => ['product-show'],
            'name' => 'product',
            'icon' => 'fas fa-gift',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.product.index'),
        ];

        $menu[] = [
            'title' => "اسلایدرها",
            'permission' => ['slider-show'],
            'name' => 'slider',
            'icon' => 'fas fa-cube',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.slider.index'),
        ];



        // $menu[] = [
        //     'title' => "رویدادها",
        //     'permission' => ['event-list', 'event-show'],
        //     'name' => 'events',
        //     'icon' => 'fas fa-users',
        //     // 'icon' => 'fas fa-user-circle',
        //     'link' => route('admin.event.index'),
        //     'counter' => $eventsCount,
        // ];

        $this->main_menus = $menu;
    }




    public function centerMenus()
    {
        $menu = [
            [
                'title' => "مرکز «{$this->center->name}»",
                'permission' => ['schedule-list', 'room-list', 'schedule-assign', 'center-edit'],
                'name' => 'schedules',
                'icon' => 'fas fa-hand-pointer',
                'sub' => [
                    [
                        'title' => "مرکز و اتاق‌ها",
                        'permission' => ['room-list'],
                        // 'icon' => 'fas fa-igloo',
                        'link' => route('admin.center.show', $this->center->id),
                        // 'link' => route('admin.center.room.index', $this->center->id),
                    ],
                    [
                        'title' => "زمان‌بندی رزرو",
                        'permission' => ['schedule-list'],
                        // 'icon' => 'fas fa-clock',
                        'link' => route('admin.center.schedule.index', $this->center->id),
                    ],
                    [
                        'title' => "تخصیص زمان‌بندی به اتاق",
                        'permission' => ['schedule-assign'],
                        // 'icon' => 'fas fa-link',
                        'link' => route('admin.center.room.schedule.index', $this->center->id),
                    ],
                    [
                        'title' => "اعضا",
                        'permission' => ['center-edit'],
                        // 'icon' => 'fas fa-link',
                        'link' => route('admin.center.member.index', $this->center->id),
                    ],
                    [
                        'title' => "نقش‌ها",
                        'permission' => ['role-show'],
                        // 'icon' => 'fas fa-link',
                        'link' => route('admin.center.role.index', $this->center->id),
                    ],
                ],
            ],

        ];

        $this->center_menus = $menu;
    }


    public function buttomMenus()
    {
        $this->bottom_menus[] = [
            'title' => 'خروج از سامانه',
            'name' => '',
            'permission' => 'panel-show',
            // 'icon' => 'fa fa-power-off',
            'icon' => 'fas fa-sign-out-alt',
            'class' => '',
            'link' => route('logout'),
        ];
    }





    /**
     * Bind data to the view.
     *
     * @param View  $view
     * @return void
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function compose(View $view)
    {
        $this->current_user = Auth::user();

        // منوهایی که به مرکز انتخاب شده ربطی ندارند
        $this->mainMenus($this->current_user);


        // منوهای پایین
        $this->buttomMenus();

        // $view->with('_user', $this->current_user);
        $view->with('_main_menus', $this->main_menus);
        $view->with('_bottom_menus', $this->bottom_menus);
    }
}
