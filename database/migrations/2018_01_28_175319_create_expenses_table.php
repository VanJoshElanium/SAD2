<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table ->increments('expense_id');
            $table ->integer('expense_term_id') -> unsigned();
            
            $table ->string('expense_name', '50');
            // $table ->string('expense_desc', '100') -> nullable();
            $table ->int('expense_amt');

            $table ->foreign('expense_term_id')
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
        Schema::dropIfExists('expenses');
    }
}
