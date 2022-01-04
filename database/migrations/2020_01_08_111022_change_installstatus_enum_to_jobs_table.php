<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInstallstatusEnumToJobsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getDoctrineSchemaManager()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('jobs', function (Blueprint $table) {
            $table->renameColumn('install_status', 'tmpName');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->enum('install_status', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9'
            ])
                ->nullable()
                ->comment('Install Status: 1->Requested,2->Artwork Created,3->Artwork Approved,4->Printed,5->Installed,6->Removal Request,7->Removal,8->Task Requested,9->Not Installed');
        });

        $all = DB::table('jobs')->get();

        foreach ($all as $item) {
            DB::table('jobs')->where('id', $item->id)->update([
                'install_status' => $item->tmpName
            ]);
        }

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('tmpName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
}
