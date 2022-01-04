<?php
use App\Events\Backend\User\UserCreated;
use App\Models\User;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use App\Models\Permission;

/**
 * Class UserTableSeeder.
 */
class UserTableUpdateSeeder extends Seeder
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
                'first_name' => 'Print',
                'last_name' => 'User',
                'name' => 'Print User',
                'email' => 'print@signcreators.com',
                'password' => 'Working@2020',
                'mobile' => '1234567890',
                'date_of_birth' => Carbon::now(),
                'avatar' => 'img/1000px-blue-cube-logo.jpg',
                'gender' => 'Man',
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user_data) {
            $user = User::create($user_data);
            event(new UserCreated($user));
        }
        $print = User::where([
            'first_name' => 'print',
            'last_name' => 'user',
            'email' => 'print@signcreators.com'
        ])->firstOrFail()->assignRole('print');

        $print->givePermissionTo(Permission::all());

        $this->enableForeignKeys();
    }
}
