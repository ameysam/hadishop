<?php

namespace Database\Seeders;

use App\Constants\Types\Permission\PermissionType;
use App\Constants\Types\Role\RoleType;
use App\Constants\Types\User\UserActivationStatusType;
use App\Constants\Types\User\UserGenderType;
use App\Models\Center;
use App\Models\PermissionTitle;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            [
                'title' => 'پنل',
                'detail' => [
                    [
                        'name' => 'panel-show',
                        'title' => 'دسترسی به پنل'
                    ],
                ]
            ],
            [
                'title' => 'مراکز',
                'detail' => [
                    [
                        'name' => 'center-list',
                        'title' => 'لیست مراکز'
                    ],
                    [
                        'name' => 'center-add',
                        'title' => 'افزودن مرکز',
                        'type' => PermissionType::PERMISSION_SYSTEM,
                    ],
                    [
                        'name' => 'center-show',
                        'title' => 'مشاهده مرکز'
                    ],
                    [
                        'name' => 'center-edit',
                        'title' => 'ویرایش مرکز'
                    ],
                    [
                        'name' => 'center-delete',
                        'title' => 'حذف مرکز',
                        'type' => PermissionType::PERMISSION_SYSTEM,
                    ],
                ]
            ],
            [
                'title' => 'اتاق‌ها',
                'detail' => [
                    [
                        'name' => 'room-list',
                        'title' => 'لیست اتاق‌ها'
                    ],
                    [
                        'name' => 'room-add',
                        'title' => 'افزودن اتاق'
                    ],
                    [
                        'name' => 'room-show',
                        'title' => 'مشاهده اتاق'
                    ],
                    [
                        'name' => 'room-edit',
                        'title' => 'ویرایش اتاق'
                    ],
                    [
                        'name' => 'room-delete',
                        'title' => 'حذف اتاق'
                    ],
                ]
            ],
            [
                'title' => 'زمان‌بندی ها',
                'detail' => [
                    [
                        'name' => 'schedule-list',
                        'title' => 'لیست زمان‌بندی ها'
                    ],
                    [
                        'name' => 'schedule-add',
                        'title' => 'افزودن زمان‌بندی'
                    ],
                    [
                        'name' => 'schedule-show',
                        'title' => 'مشاهده زمان‌بندی'
                    ],
                    [
                        'name' => 'schedule-edit',
                        'title' => 'ویرایش زمان‌بندی'
                    ],
                    [
                        'name' => 'schedule-delete',
                        'title' => 'حذف زمان‌بندی'
                    ],
                    [
                        'name' => 'schedule-assign',
                        'title' => 'تخصیص زمان‌بندی به اتاق'
                    ],
                ]
            ],
            [
                'title' => 'جلسات',
                'detail' => [
                    [
                        'name' => 'meeting-list',
                        'title' => 'لیست جلسات'
                    ],
                    [
                        'name' => 'meeting-add',
                        'title' => 'افزودن جلسه'
                    ],
                    [
                        'name' => 'meeting-show',
                        'title' => 'مشاهده جلسه'
                    ],
                    [
                        'name' => 'meeting-edit',
                        'title' => 'ویرایش جلسه'
                    ],
                    [
                        'name' => 'meeting-delete',
                        'title' => 'حذف جلسه'
                    ],
                    [
                        'name' => 'meeting-list-search',
                        'title' => 'جستجوی جلسه'
                    ],
                ]
            ],
            [
                'title' => 'رويدادها',
                'detail' => [
                    [
                        'name' => 'event-list',
                        'title' => 'لیست رويدادها'
                    ],
                    [
                        'name' => 'event-add',
                        'title' => 'افزودن رويداد'
                    ],
                    [
                        'name' => 'event-show',
                        'title' => 'مشاهده رويداد'
                    ],
                    [
                        'name' => 'event-edit',
                        'title' => 'ویرایش رويداد'
                    ],
                    [
                        'name' => 'event-delete',
                        'title' => 'حذف رويداد'
                    ],
                ]
            ],
            [
                'title' => 'نقش‌ها',
                'detail' => [
                    [
                        'name' => 'role-show',
                        'title' => 'مشاهده نقش'
                    ],
                    [
                        'name' => 'role-add',
                        'title' => 'افزودن نقش'
                    ],
                    [
                        'name' => 'role-edit',
                        'title' => 'ویرایش نقش'
                    ],
                    [
                        'name' => 'role-delete',
                        'title' => 'حذف نقش'
                    ],
                ]
            ],
            [
                'title' => 'کاربران',
                'detail' => [
                    [
                        'name' => 'user-add',
                        'title' => 'افزودن کاربر'
                    ],
                    [
                        'name' => 'user-show',
                        'title' => 'مشاهده کاربر'
                    ],
                    [
                        'name' => 'user-edit',
                        'title' => 'ویرایش کاربر'
                    ],
                    [
                        'name' => 'user-delete',
                        'title' => 'حذف کاربر'
                    ],
                    [
                        'name' => 'user-assign-role',
                        'title' => 'اختصاص نقش به کاربر'
                    ],
                ]
            ],
        ];

        foreach ($permissions as $permission)
        {
            $permissionTitle = PermissionTitle::create(['title' => $permission['title']]);
            foreach ($permission['detail'] as $detail)
            {
                $permissionTitle->permissions()->create($detail);
            }
        }



        // Create user and role
        $accounts = [
            [
                'user' => [
                    'first_name' => 'حامد',
                    'last_name' => 'رامشینی',
                    'id_no' => '0072439297',
                    'mobile_no' => '09194828722',
                    'password' => '123456',
                    'email' => 'hamedramshini@gmail.com',
                    'gender' => UserGenderType::USER_GENDER_MALE,
                    'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
                ],
                'role' => [
                    'name' => 'admin',
                    'slug' => 'admin',
                    'title' => 'مدیریت سایت',
                    'type' => RoleType::ROLE_STATIC,
                ]
            ],
            [
                'user' => [
                    'first_name' => 'میثم',
                    'last_name' => 'علیپور',
                    'id_no' => '3860448821',
                    'mobile_no' => '09129542531',
                    'password' => '123456',
                    'email' => 'meysam.alipuor@gmail.com',
                    'gender' => UserGenderType::USER_GENDER_MALE,
                    'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
                ],
                'role' => [
                    'name' => 'admin',
                    'slug' => 'admin',
                    'title' => 'مدیریت سایت',
                    'type' => RoleType::ROLE_STATIC,
                ]
            ],
        ];

        foreach ($accounts as $account)
        {
            $role = Role::where('name' ,$account['role']['name'])->first();

            if(! $role)
            {
                $role = Role::create($account['role']);
                $role->givePermissionTo(Permission::all());
            }

            $user = User::create($account['user']);
            $user->assignRole($role['id']);
        }

        $default_roles = [
            [
                'role' => [
                    'name' => 'user',
                    'slug' => 'user',
                    'title' => 'کاربر',
                    'type' => RoleType::ROLE_STATIC,
                ],
                'permissions' => [
                    'panel-show',
                    'center-show',
                    'center-list',
                    'room-show',
                    'room-list',
                    'schedule-show',
                    'schedule-list',
                    'meeting-show',
                    'meeting-list',
                ]
            ],
        ];

        foreach ($default_roles as $default_role) {
            Role::create($default_role['role'])->givePermissionTo($default_role['permissions']);
        }



        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512343',
            'mobile_no' => '09120000001',
            'password' => '123456',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512344',
            'mobile_no' => '09120000002',
            'password' => '123456',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512345',
            'mobile_no' => '09120000003',
            'password' => '123456',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512346',
            'password' => '123456',
            'mobile_no' => '09120000004',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512347',
            'password' => '123456',
            'mobile_no' => '09120000005',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512348',
            'password' => '123456',
            'mobile_no' => '09120000006',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512349',
            'password' => '123456',
            'mobile_no' => '09120000007',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512350',
            'password' => '123456',
            'mobile_no' => '09120000008',
            'activation_status' => UserActivationStatusType::USER_ACTIVATION_STATUS_ACTIVE,
        ]);

        // $center1 = Center::find(1);
        // $role1 = Role::create([
        //     'title' => 'مدیر بیمارستان',
        //     'name' => $center1->id . '-admin-place',
        //     'slug' => 'admin-place',
        //     'center_id' => $center1->id,
        // ])
        // ->givePermissionTo([1,2,3,4]);


        // $role2 = Role::create([
        //     'title' => 'مدیر بخش',
        //     'name' => $center1->id . '-admin-section',
        //     'slug' => 'admin-section',
        //     'center_id' => $center1->id,
        // ]);
        // $role2->givePermissionTo([1, 4 ,6]);

        // $role3 = Role::create([
        //     'title' => 'پزشک',
        //     'name' => $center1->id . '-doctor',
        //     'slug' => 'doctor',
        //     'center_id' => $center1->id,
        // ]);
        // $role3->givePermissionTo([1, 20, 22]);

        // $role4 = Role::create([
        //     'title' => 'دستیار پزشک',
        //     'name' => $center1->id . '-doctor-assistant',
        //     'slug' => 'doctor-assistant',
        //     'center_id' => $center1->id,
        // ]);
        // $role4->givePermissionTo([1, 15, 19, 21]);

        // $role5 = Role::create([
        //     'title' => 'پرستار',
        //     'name' => $center1->id . '-nurse',
        //     'slug' => 'nurse',
        //     'center_id' => $center1->id,
        // ]);
        // $role5->givePermissionTo([1, 15, 2, 21]);

        // $role6 = Role::create([
        //     'title' => 'منشی',
        //     'name' => $center1->id . '-secretary',
        //     'slug' => 'secretary',
        //     'center_id' => $center1->id,
        // ]);
        // $role6->givePermissionTo([1, 20, 22, 14, 13, 15, 16, 17]);

        // $center2 = Center::find(2);
        // $role7 = Role::create([
        //     'title' => 'مدیر کلینیک',
        //     'name' => $center2->id . '-admin-place',
        //     'slug' => 'admin-place',
        //     'center_id' => $center2->id,
        // ]);
        // $role7->givePermissionTo([1, 9, 11, 14, 10]);

        // $role8 = Role::create([
        //     'title' => 'پزشک',
        //     'name' => $center2->id . '-doctor',
        //     'slug' => 'doctor',
        //     'center_id' => $center2->id,
        // ]);
        // $role8->givePermissionTo([1, 12, 3, 14, 19, 15, 6, 14]);

        // $role9 = Role::create([
        //     'title' => 'دستیار پزشک',
        //     'name' => $center2->id . '-doctor-assistant',
        //     'slug' => 'doctor-assistant',
        //     'center_id' => $center2->id,
        // ]);
        // $role9->givePermissionTo([1, 3, 5, 19, 22]);

        // $role10 = Role::create([
        //     'title' => 'پرستار',
        //     'name' => $center2->id . '-nurse',
        //     'slug' => 'nurse',
        //     'center_id' => $center2->id,
        // ]);
        // $role10->givePermissionTo([1, 20, 21, 5, 6, 18]);

        // $role11 = Role::create([
        //     'title' => 'منشی',
        //     'name' => $center2->id . '-secretary',
        //     'slug' => 'secretary',
        //     'center_id' => $center2->id,
        // ]);
        // $role11->givePermissionTo([1, 10, 20, 22]);


        // $center3 = Center::find(3);
        // $role12 = Role::create([
        //     'title' => 'مدیر کلینیک',
        //     'name' => $center3->id . '-admin-place',
        //     'slug' => 'admin-place',
        //     'center_id' => $center3->id,
        // ]);
        // $role12->givePermissionTo([1, 20, 8, 18, 14, 19]);

        // $role13 = Role::create([
        //     'title' => 'پزشک',
        //     'name' => $center3->id . '-doctor',
        //     'slug' => 'doctor',
        //     'center_id' => $center3->id,
        // ]);
        // $role13->givePermissionTo([1, 11, 13, 2, 15]);

        // $role14 = Role::create([
        //     'title' => 'منشی',
        //     'name' => $center3->id . '-secretary',
        //     'slug' => 'secretary',
        //     'center_id' => $center3->id,
        // ]);
        // $role14->givePermissionTo([1, 15, 18, 19, 17, 22]);

        // $center4 = Center::find(4);
        // $role15 = Role::create([
        //     'title' => 'پزشک',
        //     'name' => $center4->id . '-doctor',
        //     'slug' => 'doctor',
        //     'center_id' => $center4->id,
        // ]);
        // $role15->givePermissionTo([1, 15, 16, 17, 19, 21]);

        // $role16 = Role::create([
        //     'title' => 'منشی',
        //     'name' => $center4->id . '-secretary',
        //     'slug' => 'secretary',
        //     'center_id' => $center4->id,
        // ]);
        // $role16->givePermissionTo([1, 6, 3, 4, 16, 18]);
    }
}
