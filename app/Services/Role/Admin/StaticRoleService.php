<?php

namespace App\Services\Role\Admin;

use App\Constants\Types\Role\RoleType;
use App\Models\Center;
use App\Services\Contracts\Service;
use Spatie\Permission\Models\Role;

class StaticRoleService extends Service
{


    public function makeCenterAllStaticRoles(Center $center)
    {
        # Make support role
        $supoort = $this->makeCenterSupporterRole($center);

        # Make Online Visit viewer role
        $online_visit_viewer = $this->makeCenterOnlineVisitViewerRole($center);

        # Make Online Visit editor role
        $online_visit_editor = $this->makeCenterOnlineVisitEditorRole($center);

        # Make Online Advice viewer role
        $online_advice_viewer = $this->makeCenterOnlineAdviceViewerRole($center);

        # Make Online Advice editor role
        $online_advice_editor = $this->makeCenterOnlineAdviceEditorRole($center);

        return [
            'supporter' => $supoort,
            'online_visit_viewer' => $online_visit_viewer,
            'online_visit_editor' => $online_visit_editor,
            'online_advice_viewer' => $online_advice_viewer,
            'online_advice_editor' => $online_advice_editor,
        ];
    }


    /**
     * @param Center $center
     * @return bool|Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function makeCenterOnlineVisitViewerRole(Center $center)
    {
        # Check
        $role_exists = Role::where(['name' => "{$center->id}-ovisit-viewer"])->first();

        if($role_exists)
        {
            return $role_exists;
        }

        $role = $center->roles()->create([
            'name' => "{$center->id}-ovisit-viewer",
            'slug' => "ovisit-viewer",
            'title' => "مشاهده ویزیت آنلاین",
            'guard_name' => 'web',
            'type' => RoleType::ROLE_STATIC,
        ]);
        $role->givePermissionTo(['panel-show', 'patient-case', 'online-visit-list', 'online-visit-show', 'drug-show', 'center-list', 'center-show']);

        return $role;
    }

    /**
     * @param Center $center
     * @return bool|Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function makeCenterOnlineAdviceViewerRole(Center $center)
    {
        # Check
        $role_exists = Role::where(['name' => "{$center->id}-oadvice-viewer"])->first();

        if($role_exists)
        {
            return $role_exists;
        }

        $role = $center->roles()->create([
            'name' => "{$center->id}-oadvice-viewer",
            'slug' => "oadvice-viewer",
            'title' => "مشاهده مشاوره آنلاین",
            'guard_name' => 'web',
            'type' => RoleType::ROLE_STATIC,
        ]);
        $role->givePermissionTo(['panel-show', 'patient-case', 'online-advice-list', 'online-advice-show', 'drug-show', 'center-list', 'center-show']);

        return $role;
    }


    /**
     * @param Center $center
     * @return bool|Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function makeCenterOnlineVisitEditorRole(Center $center)
    {
        $role_exists = Role::where(['name' => "{$center->id}-ovisit-editor"])->first();

        if($role_exists)
        {
            return $role_exists;
        }

        $role = $center->roles()->create([
            'name' => "{$center->id}-ovisit-editor",
            'slug' => "ovisit-editor",
            'title' => "مشاهده/ویرایش ویزیت آنلاین",
            'guard_name' => 'web',
            'type' => RoleType::ROLE_STATIC,
        ]);
        $role->givePermissionTo(['panel-show', 'patient-case', 'online-visit-list', 'online-visit-show', 'online-visit-edit', 'drug-add', 'drug-show', 'drug-edit', 'perscription-add', 'center-list', 'center-show']);

        return $role;
    }

    /**
     * @param Center $center
     * @return bool|Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function makeCenterOnlineAdviceEditorRole(Center $center)
    {
        $role_exists = Role::where(['name' => "{$center->id}-oadvice-editor"])->first();

        if($role_exists)
        {
            return $role_exists;
        }

        $role = $center->roles()->create([
            'name' => "{$center->id}-oadvice-editor",
            'slug' => "oadvice-editor",
            'title' => "مشاهده/ویرایش مشاوره آنلاین",
            'guard_name' => 'web',
            'type' => RoleType::ROLE_STATIC,
        ]);
        $role->givePermissionTo(['panel-show', 'patient-case', 'online-advice-list', 'online-advice-show', 'online-advice-edit', 'drug-add', 'drug-show', 'drug-edit', 'perscription-add', 'center-list', 'center-show']);

        return $role;
    }


    /**
     * @param Center $center
     * @return bool|Role
     * @author M.Alipuor <meysam.alipuor@gmail.com>
     */
    public function makeCenterSupporterRole(Center $center)
    {
        $role_exists = Role::where(['name' => "{$center->id}-supporter"])->first();

        if($role_exists)
        {
            return $role_exists;
        }

        $role = $center->roles()->create([
            'name' => "{$center->id}-supporter",
            'slug' => "supporter",
            'title' => "پشتیبان مرکز",
            'guard_name' => 'web',
            'type' => RoleType::ROLE_STATIC,
        ]);
        $role->givePermissionTo([
            'panel-show',
            'patient-case',
            'online-visit-list',
            'online-visit-show',
            'online-visit-operation',
            'online-advice-list',
            'online-advice-show',
            'online-advice-operation',
            'drug-show',
            'center-list',
            'center-show',
            'center-support'
            ]);

        return $role;
    }
}
