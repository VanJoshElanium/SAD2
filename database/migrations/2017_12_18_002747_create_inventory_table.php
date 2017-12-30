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
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('inventory_id');
            $table->integer('inventory_supply_id');
            $table->integer('inventory_user_id');
            $table->integer('inventory_price');
            $table->integer('inventory_quantity');
            $table->integer('inventory_status')->default(1);
            $table->integer('inventory_damaged');
            $table->dateTime('received_at');

            $table->foreign('inventory_supply_id')
                    ->references('supply_id')
                    ->on('supplies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('inventory_user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->rememberToken();
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
