<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusEnumToOtherTasksTable extends Migration
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

        Schema::table('other_tasks', function (Blueprint $table) {
            $table->renameColumn('status', 'tmpName');
        });
        Schema::table('other_tasks', function (Blueprint $table) {
            $table->enum('status', [
                '1',
                '2'
            ])
                ->nullable()
                ->comment('Status of task: 1->Completed, 2=>Not Completed');
        });

        $all = DB::table('other_tasks')->get();

        foreach ($all as $item) {
            DB::table('other_tasks')->where('id', $item->id)->update([
                'status' => $item->tmpName
            ]);
        }

        Schema::table('other_tasks', function (Blueprint $table) {
            $table->dropColumn('tmpName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {}
}
