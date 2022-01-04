<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInstallCompleteDateToInstallersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installers', function (Blueprint $table) {
            $table->date('install_complete_date')
                ->nullable()
                ->after('other_task_completed_date')
                ->comment('Installation Complete Date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installers', function (Blueprint $table) {
            $table->dropColumn('install_complete_date');
        });
    }
}
