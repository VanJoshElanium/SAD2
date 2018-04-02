<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table -> increments('customer_id');
            $table -> integer('customer_profile_id') -> unsigned();
            $table -> string('customer_addr', '100');

            $table ->foreign('customer_profile_id')
                    ->references('profile_id')
                    ->on('profiles')
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
        Schema::dropIfExists('customers');
    }
}
