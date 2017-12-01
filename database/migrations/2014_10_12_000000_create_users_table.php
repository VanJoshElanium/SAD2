<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

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
            $table->string('cnum', '11');
            $table->integer('user_type');
            $table->integer('user_status');
            $table->rememberToken();
            $table->timestamps();
        });

        $password = bcrypt('admin123');
        $current_time = Carbon::now()->toDateTimeString();

        DB::table('users')->insert(
        array(
            'fname' => 'Admin',
            'mname' => 'A',
            'lname' => 'Admin', 
            'username' => 'admin123',
            'password' => $password,
            'gender' => 1,
            'bday' => '2017-01-12',
            'cnum' => '12345678900',
            'user_type' => 0,
            'user_status' => 1,
            'created_at' => $current_time,
            'updated_at' => $current_time
        )
 
    );
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
