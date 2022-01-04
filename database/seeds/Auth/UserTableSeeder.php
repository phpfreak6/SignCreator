<?php

use App\Events\Backend\User\UserCreated;
use App\Models\User;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        $users = [
            [
                'first_name'        => 'Super',
                'last_name'         => 'Admin',
                'name'              => 'Super Admin',
                'email'             => 'super@signcreators.com',
                'password'          => 'Working@2020',
                'mobile'            => '1234567890',
                'date_of_birth'     => Carbon::now(),
                'avatar'            => 'img/1000px-blue-cube-logo.jpg',
                'gender'            => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at'      => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Admin',
                'last_name'         => 'Istrator',
                'name'              => 'Admin Istrator',
                'email'             => 'admin@signcreators.com',
                'password'          => 'Working@2020',
              'mobile'            => '1234567890',
                'date_of_birth'     => Carbon::now(),
                'avatar'            => 'img/1000px-blue-cube-logo.jpg',
                'gender'            => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at'      => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Manager',
                'last_name'         => 'User User',
                'name'              => 'Manager',
                'email'             => 'manager@signcreators.com',
                'password'          => 'Working@2020',
               'mobile'            => '1234567890',
                'date_of_birth'     => Carbon::now(),
                'avatar'            => 'img/1000px-blue-cube-logo.jpg',
                'gender'            => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at'      => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'Executive',
                'last_name'         => 'User',
                'name'              => 'Executive User',
                'email'             => 'executive@signcreators.com',
                'password'          => 'Working@2020',
                'mobile'            => '1234567890',
                'date_of_birth'     => Carbon::now(),
                'avatar'            => 'img/1000px-blue-cube-logo.jpg',
                'gender'            => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at'      => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'first_name'        => 'General',
                'last_name'         => 'User',
                'name'              => 'General User',
                'email'             => 'user@signcreators.com',
                'password'          => 'Working@2020',
                 'mobile'            => '1234567890',
                'date_of_birth'     => Carbon::now(),
                'avatar'            => 'img/1000px-blue-cube-logo.jpg',
                'gender'            => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at'      => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
			    [
                'first_name'        => 'Installer',
                'last_name'         => 'User',
                'name'              => 'Installer User',
                'email'             => 'installer@signcreators.com',
                'password'          => 'Working@2020',
                 'mobile'            => '1234567890',
                'date_of_birth'     => Carbon::now(),
                'avatar'            => 'img/1000px-blue-cube-logo.jpg',
                'gender'            => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at'      => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);
            event(new UserCreated($user));
        }

        $this->enableForeignKeys();
    }
}
