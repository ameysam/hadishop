<?php

namespace App\Listeners\Center;

use App\Events\Center\CenterUpdateEvent;
use App\Services\Role\Admin\RoleService;
use App\Services\User\Admin\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CenterDetachOldAdminRoleListener
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
     * @param  CenterUpdateEvent  $event
     * @return void
     */
    public function handle(CenterUpdateEvent $event)
    {
        $center = $event->center;

        $old_admins_ids = $event->oldAdminIDs;

        if($old_admins_ids)
        {
            $this->userService->multiDetachRole($old_admins_ids, $center->adminRoleName());
        }
    }
}
