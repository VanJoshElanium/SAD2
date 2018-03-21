<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockins', function (Blueprint $table) {
            $table ->increments('si_id');
            $table ->integer('si_inventory_id') -> unsigned();
            $table ->integer('si_si_id') -> unsigned();
            
            $table ->integer('si_qty');
            $table ->dateTime('si_date');

            $table ->foreign('si_inventory_id')
                    ->references('inventory_id')
                    ->on('inventories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('si_si_id')
                    ->references('si_item_id')
                    ->on('stockin_items')
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
        Schema::dropIfExists('stockins');
    }
}
