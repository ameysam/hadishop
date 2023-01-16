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
                'title' => 'کالاها',
                'detail' => [
                    [
                        'name' => 'product-list',
                        'title' => 'لیست کالاها'
                    ],
                    [
                        'name' => 'product-add',
                        'title' => 'افزودن کالا',
                    ],
                    [
                        'name' => 'product-show',
                        'title' => 'مشاهده کالا'
                    ],
                    [
                        'name' => 'product-edit',
                        'title' => 'ویرایش کالا'
                    ],
                    [
                        'name' => 'product-delete',
                        'title' => 'حذف کالا',
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
                    'first_name' => 'هادی',
                    'last_name' => 'بختیاری',
                    'id_no' => '1231231230',
                    'mobile_no' => '09123456789',
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
                    'id_no' => '2222222222',
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
    }
}
