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

            $table -> string('customer_fname', '50');
            $table -> string('customer_mname', '1');
            $table -> string('customer_lname', '50');

            $table -> integer('customer_gender');
            $table -> string('customer_addr', '100');
            $table -> string('customer_cnum', '11');
            $table -> integer('customer_status');
            
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
