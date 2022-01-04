<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherTaskTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->nullable();
            $table->integer('task_id')->nullable();
            $table->text('notes')
                ->nullable()
                ->comment('Notes');
            $table->enum('status', [
                1
            ])
                ->nullable()
                ->comment('Status of task: 1->Completed');

            $table->string('reference_pic', 192)->nullable();
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
        Schema::dropIfExists('other_tasks');
    }
}
