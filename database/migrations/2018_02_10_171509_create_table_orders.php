<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table ->increments('order_id');
            $table ->integer('order_ti_id') -> unsigned();
            $table ->integer('order_co_id') -> unsigned();
        

            $table ->integer('order_qty');

            $table ->foreign('order_co_id')
                    ->references('co_id')
                    ->on('customer_orders')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('order_ti_id')
                    ->references('ti_id')
                    ->on('term_items')
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
        Schema::dropIfExists('orders');
    }
}
