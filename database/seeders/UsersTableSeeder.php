<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'first_name' => 'حامد',
            'last_name' => 'رامشینی',
            'id_no' => '0072439297',
            'mobile_no' => '09194828722',
            'password' => '39297',
        ]);

        $user2 = User::create([
            'first_name' => 'میثم',
            'last_name' => 'علیپور',
            'id_no' => '3860448821',
            'mobile_no' => '09129542531',
            'password' => '48821',
        ]);

        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512343',
            'mobile_no' => '09120000001',
            'password' => '123456',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512344',
            'mobile_no' => '09120000002',
            'password' => '123456',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512345',
            'mobile_no' => '09120000003',
            'password' => '123456',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512346',
            'password' => '123456',
            'mobile_no' => '09120000004',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512347',
            'password' => '123456',
            'mobile_no' => '09120000005',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512348',
            'password' => '123456',
            'mobile_no' => '09120000006',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512349',
            'password' => '123456',
            'mobile_no' => '09120000007',
        ]);
        User::create([
            'first_name' => 'رزرو',
            'last_name' => 'رزرو',
            'id_no' => '1234512350',
            'password' => '123456',
            'mobile_no' => '09120000008',
        ]);
    }
}
