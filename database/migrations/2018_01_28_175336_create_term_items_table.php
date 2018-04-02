<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_items', function (Blueprint $table) {
            $table ->increments('ti_id');
            $table ->integer('ti_term_id') -> unsigned();
            $table ->integer('ti_inventory_id') -> unsigned();
            $table ->integer('ti_user_id') -> unsigned();
            
            $table ->integer('ti_price');
            $table ->dateTime('ti_date');
            $table ->integer('ti_original');
            $table ->integer('ti_udamaged') -> nullable() -> default(0);
            $table ->integer('ti_rdamaged') -> nullable() -> default(0);
            $table ->integer('ti_returned') -> nullable() -> default(0);


            $table ->foreign('ti_term_id')
                    ->references('term_id')
                    ->on('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('ti_user_id')
                    ->references('user_id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('ti_inventory_id')
                    ->references('inventory_id')
                    ->on('inventories')
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
        Schema::dropIfExists('term_items');
    }
}
