<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AuthTableSeeder::class);
        $this->call(UserRoleTableUpdateSeeder::class);
        $this->call(UserTableUpdateSeeder::class);

        Model::reguard();
    }
}
