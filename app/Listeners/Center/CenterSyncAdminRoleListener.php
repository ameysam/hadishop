<?php

namespace App\Listeners\Center;

use App\Events\Center\CenterSaveEvent;
use App\Services\Role\Admin\RoleService;
use App\Services\User\Admin\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CenterSyncAdminRoleListener
{
    private $userService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     *
     * @param mixed $event
     * @return void
     */
    public function handle($event)
    {
        $center = $event->center;

        # Attach admin role to admins
        if($center->admins_quick)
        {
            $this->userService->multiSyncRole($center->admins_quick, [$center->adminRoleName()]);
        }
    }
}
