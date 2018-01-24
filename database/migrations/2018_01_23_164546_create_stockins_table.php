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
            $table ->integer('si_inventory_id');
            $table ->integer('si_user_id');
            $table ->dateTime('si_date');

            $table ->foreign('si_inventory_id')
                    ->references('inventory_id')
                    ->on('inventories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('si_user_id')
                    ->references('user_id')
                    ->on('users')
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
