<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->text('pro_address')
                ->nullable()
                ->comment('Property Address');
            $table->string('suburb', 192)->nullable();
            $table->string('post_code', 192)->nullable();
            $table->string('state', 192)->nullable();
            $table->enum('pro_type', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6'
            ])
                ->nullable()
                ->comment('Property Type: 1->Residential,2->Office,3->Commercial,4->Retail,5->Industrial,6->Land');
            $table->enum('sign_type', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6'
            ])
                ->nullable()
                ->comment('Sign type: 1->Stockboard,2->Textboard,3->Photoboard,4->Window Graphic,5->Banner,6->Other');
            $table->enum('size', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8'
            ])
                ->nullable()
                ->comment('Size: 1->1200X900mm(4X3),2->1800X1200mm(6X4),3->2400X1800mm(8X6),4->2400X2400MM,5->3000X2400mm(10x8),6->3600x2400mm(12x8)
,7->4800x2400mm,8->Other');
            $table->enum('orientation', [
                '1',
                '2'
            ])
                ->nullable()
                ->comment('Orientation: 1->Portrait,2->Landscape');
            $table->enum('listing_type', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6'
            ])
                ->nullable()
                ->comment('listing type: 1->For Sale,2->For Lease,3->For Rent,4->Sale/Lease,5->Auction,6->EOI');
            $table->integer('quantity')->nullable();
            $table->enum('v_board', [
                '1',
                '2'
            ])
                ->nullable()
                ->comment('V Board: 1->yes,2->No');
            $table->string('overlays', 192)->nullable();
            $table->string('install_notes', 192)->nullable();
            $table->enum('terms_conditions', [
                0,
                1
            ])
                ->nullable()
                ->comment('Terms n Conditions: 0->Accept,1->Not Accept');
            $table->enum('marketting_confirm', [
                0,
                1
            ])
                ->nullable()
                ->comment('Marketting Confirm: 0->Accept,1->Not Accept');
            $table->enum('install_pic_check', [
                0,
                1
            ])
                ->nullable()
                ->comment('Installation Picture Check: 0->Accept,1->Not Accept');
            $table->string('install_pic', 192)->nullable();
            $table->enum('reference_pic_check', [
                0,
                1
            ])
                ->nullable()
                ->comment('Reference Picture Check: 0->Accept,1->Not Accept');
            $table->string('reference_pic', 192)->nullable();
            $table->enum('artwork_required', [
                1,
                2
            ])
                ->nullable()
                ->comment('Artwork Required: 1->Not Required,2->Required');
            $table->enum('anti_grafiti_lamin', [
                0,
                1
            ])
                ->nullable()
                ->comment('Anti Grafiti Lamination: 0->Accept,1->Not Accept');
            $table->enum('flag_holder', [
                0,
                1
            ])
                ->nullable()
                ->comment('FLag Holder: 0->Accept,1->Not Accept');
            $table->enum('solor_spot', [
                0,
                1
            ])
                ->nullable()
                ->comment('Solor Spotlight: 0->Accept,1->Not Accept');
            $table->enum('status', [
                0,
                1,
                2
            ])
                ->nullable()
                ->comment('Job Status: 0->Inactive,1->Active,2->canceljob');
            $table->enum('install_status', [
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8'
            ])
                ->nullable()
                ->comment('Install Status: 1->Requested,2->Artwork Created,3->Artwork Approved,4->Printed,5->Installed,6->Removal Request,7->Removal,8->Task Requested');
            $table->enum('printing_status', [
                0,
                1
            ])
                ->nullable()
                ->comment('Printing Status:1->completed');
            $table->date('printing_complete_date')
                ->nullable()
                ->comment('Printing Complete date');
            $table->integer('parent_id')->nullable();
            $table->text('other_note')
                ->nullable()
                ->comment('Other Job Note');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
