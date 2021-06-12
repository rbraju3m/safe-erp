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
        Schema::create('expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255)->nullable();
            $table->string('amount',255)->nullable();
            $table->string('ex_date',255)->nullable();
            $table->text('note')->nullable();
            
            $table->string('image_link',128)->nullable();
            $table->enum('status',array('active','inactive'))->nullable();

            $table->string('expense_day',50)->nullable();
            $table->string('expense_month',50)->nullable();
            $table->string('expense_year',50)->nullable();
            $table->string('expense_time',50)->nullable();
            $table->string('expense_date',50)->nullable();

            
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense');
    }
}
