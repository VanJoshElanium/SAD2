<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table ->increments('repair_id');
            $table ->integer('repair_inventory_id') -> unsigned();
            $table ->integer('repair_term_id') -> unsigned() -> nullable();
            $table ->integer('repair_user_id') -> unsigned();
            
            $table ->foreign('repair_inventory_id')
                    ->references('inventory_id')
                    ->on('inventories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('repair_user_id')
                    ->references('user_id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('repair_term_id')
                    ->references('term_id')
                    ->on('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->integer('repair_qty');
            $table ->dateTime('repair_ddate');
            $table ->dateTime('repair_fdate') -> nullable();
            $table ->integer('repair_status') -> default(0);
            $table ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
