<?php

namespace App\Http\View\Composers;

use App\Models\Month;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Center;
use App\Models\Meeting;
use App\Services\User\Admin\UserModeService;

class SidebarMenuComposer
{
    /**
     * @var Center
     */
    private $center;


    private $main_menus = [];

    private $center_menus = [];

    private $bottom_menus = [];


    /**
     * LayoutAdminComposer constructor.
     * @param Center $center
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function __construct(Center $center = null/*, UserModeService $userModeService*/)
    {
        $this->center = $center;

        // $this->userModeService = $userModeService;
    }

    private function mainMenus($user)
    {
        $menu = [];



        if($user->isSuperAdmin())
        {
            $menu[] = [
                'title' => "کاربران",
                'permission' => ['user-show'],
                'name' => 'roles',
                'icon' => 'fas fa-users',
                // 'icon' => 'fas fa-user-circle',
                'link' => route('admin.user.index'),
            ];
            $menu[] = [
                'title' => "نقش‌ها",
                'permission' => ['role-show'],
                'name' => 'roles',
                'icon' => 'fas fa-handshake',
                // 'icon' => 'fas fa-user-circle',
                'link' => route('admin.role.index'),
            ];

            $centersCount = Center::whereActive()->count();
            $meetingsCount = Meeting::whereActive()->count();
        }
        else
        {
            $centersCount = $user->centers()->count();
            $meetingsCount = $user->meetings()->count();
        }
        $eventsCount = $user->events()->whereNotExpired()->count();


        $menu[] = [
            'title' => "مراکز",
            'permission' => ['center-list'],
            'name' => 'centers',
            'icon' => 'fas fa-home',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.center.index'),
            'counter' => $centersCount,
        ];
        $menu[] = [
            'title' => "جلسات",
            'permission' => ['meeting-list', 'meeting-show'],
            'name' => 'meetings',
            'icon' => 'fas fa-users',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.meeting.index'),
            'counter' => $meetingsCount,
        ];
        $menu[] = [
            'title' => "رویدادها",
            'permission' => ['event-list', 'event-show'],
            'name' => 'events',
            'icon' => 'fas fa-users',
            // 'icon' => 'fas fa-user-circle',
            'link' => route('admin.event.index'),
            'counter' => $eventsCount,
        ];

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

        if($this->center)
        {
            // منوهای مرکزی که انتخاب شده اند
            $this->centerMenus();
        }

        // منوهای پایین
        $this->buttomMenus();

        // $view->with('_user', $this->current_user);
        $view->with('_center', $this->center);
        $view->with('_main_menus', $this->main_menus);
        $view->with('_center_menus', $this->center_menus);
        $view->with('_bottom_menus', $this->bottom_menus);
    }
}
