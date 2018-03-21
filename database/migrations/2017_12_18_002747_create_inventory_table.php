<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('inventory_id');
            $table->integer('inventory_supplier_id') -> unsigned();
            $table->string('inventory_name', '50');
            $table->string('inventory_desc', '100') -> nullable();
            $table->integer('inventory_status') ->default(1);
            $table->integer('inventory_qty') ->nullable() ->default(0);
            $table->integer('inventory_price');

            $table->foreign('inventory_supplier_id')
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
        Schema::dropIfExists('inventory');
    }
}
