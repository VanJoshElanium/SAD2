<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('supplier_id');
            $table->string('supplier_name', '50')->unique();
            $table->string('supplier_addr', '70');
            $table->string('supplier_email', '50');
            $table->integer('supplier_cnum');        
            $table->integer('supplier_status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('supply_id');
            $table->integer('supply_supplier_id');
            $table->string('supply_name', '50');
            $table->integer('supply_price');
            $table->integer('supply_status')->default(1);
            $table->foreign('supply_supplier_id')
                    ->references('supplier_id')
                    ->on('suppliers')
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
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('supplies');
    }
}
