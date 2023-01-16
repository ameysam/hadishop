<?php

namespace App\Listeners\Center;

use App\Events\Center\CenterSaveEvent;
use App\Services\Role\Admin\RoleService;
use App\Services\User\Admin\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CenterMakeAdminRoleListener
{
    private $roleService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Handle the event.
     *
     * @param  CenterSaveEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $center = $event->center;

        # Make the center admin role
        $this->roleService->makeCenterAdminRole($center);
    }
}
