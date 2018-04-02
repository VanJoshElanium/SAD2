<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('supply_id');
             $table ->integer('supplies_inventory_id') -> unsigned();
            $table ->integer('supplies_supplier_id') -> unsigned();

            $table ->foreign('supplies_inventory_id')
                    ->references('inventory_id')
                    ->on('inventories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('supplies_supplier_id')
                    ->references('supplier_id')
                    ->on('suppliers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('supplies');
    }
}
