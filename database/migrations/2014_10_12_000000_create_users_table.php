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
            $table->increments('user_id');
            $table->string('username', '50')->unique();
            $table->string('password', '255');
            $table->integer('user_type');
            $table->integer('user_status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->integer('profile_user_id') -> unsigned();
            $table->string('fname', '50');
            $table->string('mname', '50');
            $table->string('lname', '50');
            $table->integer('gender');
            $table->date('bday', '6');
            $table->string('cnum', '11');
            $table->foreign('profile_user_id')
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
        Schema::dropIfExists('users');
    }
}

?>
