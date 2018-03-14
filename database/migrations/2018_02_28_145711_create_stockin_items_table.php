<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockinItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockin_items', function (Blueprint $table) {
            $table ->increments('si_item_id');

            $table ->integer('si_user_id') -> unsigned();

            $table ->dateTime('si_date');

            $table ->foreign('si_user_id')
                    ->references('user_id')
                    ->on('users')
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
        Schema::dropIfExists('stockin_items');
    }
}
