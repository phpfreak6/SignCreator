<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->nullable();
            $table->integer('installer_id')->nullable();
            $table->date('install_date')
                ->nullable()
                ->comment('Installation date');
            $table->enum('type', [
                0,
                1
            ])
                ->nullable()
                ->comment('InstallStatus: 0->Installer,1->Removal');
            $table->integer('other_task_id')->nullable();
            $table->date('other_task_completed_date')
                ->nullable()
                ->comment('Other task Completed date');
            $table->string('install_image', 192)->nullable();
            $table->enum('installstatus', [
                0,
                1
            ])
                ->nullable()
                ->comment('InstallStatus: 0->notInstalled,1->Installed');
            $table->enum('removalstatus', [
                0,
                1
            ])
                ->nullable()
                ->comment('InstallStatus: 0->Requested,1->Removal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installers');
    }
}
