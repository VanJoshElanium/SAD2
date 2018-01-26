<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table ->increments('worker_id');
            $table ->integer('worker_user_id') -> unsigned();
            $table ->integer('worker_term_id') -> unsigned();
            $table ->integer('worker_type');

            $table ->foreign('worker_user_id')
                    ->references('user_id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table ->foreign('worker_term_id')
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
        Schema::dropIfExists('workers');
    }
}
