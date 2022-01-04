<?php
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableUpdateSeeder extends Seeder
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
        Role::create([
            'name' => 'print'
        ]);
        $this->enableForeignKeys();
    }
}
