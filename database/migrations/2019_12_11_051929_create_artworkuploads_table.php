<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworkuploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworkuploads', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('job_id')->nullable();
			$table->string('artwotk_image',192)->nullable();
			$table->enum('status',[0,1,2])->nullable()->comment('Status of artwork: 0->sent,1->Accept,2-Not Accept');
			$table->text('token')->nullable()->comment('Token');
			$table->text('comment')->nullable()->comment('Declined comment');
			$table->enum('when',[0,1])->nullable()->comment('Status of artwork: 0->NEW,1->OLD');
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
        Schema::dropIfExists('artworkuploads');
    }
}
