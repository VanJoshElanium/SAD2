<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomerOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders', function (Blueprint $table) {
            $table ->increments('co_id');
            $table ->integer('co_term_id') -> unsigned();
            $table ->integer('co_customer_id') -> unsigned();
            
            $table ->integer('co_status') -> default(0);
            $table ->date('co_collect_date') -> nullable();

            $table ->foreign('co_term_id')
                    ->references('term_id')
                    ->on('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('co_customer_id')
                    ->references('customer_id')
                    ->on('customers')
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
        Schema::dropIfExists('customer_orders');
    }
}
