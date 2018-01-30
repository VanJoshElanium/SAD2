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
            $table ->integer('repair_term_id') -> nullable() -> unsigned();
            $table ->integer('repair_user_ud') -> nullable() -> unsigned();
            
            $table ->dateTime('repair_date') -> default(Carbon::now());
            $table ->integer('repair_qty');
            $table ->string('repair_desc') -> nullable();
            $table ->integer('repair_status') -> default(0);

            $table ->foreign('repair_inventory_id')
                    ->references('inventory_id')
                    ->on('inventories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('repair_term_id')
                    ->references('term_id')
                    ->on('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
