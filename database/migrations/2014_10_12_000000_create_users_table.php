<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname', '50');
            $table->string('mname', '50');
            $table->string('lname', '50');
            $table->string('username', '50')->unique();
            $table->string('password', '255');
            $table->integer('gender');
            $table->date('bday', '6');
            $table->integer('cnum');
            $table->integer('user_type');
            $table->integer('user_status');
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
        Schema::dropIfExists('users');
    }
}

?>
