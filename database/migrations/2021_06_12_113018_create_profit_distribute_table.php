<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfitDistributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_distribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profit_year',10)->nullable();
            $table->double('net_amount',10,2)->nullable();
            $table->double('bank_profit',10,2)->nullable();
            $table->double('bank_expense',10,2)->nullable();
            $table->double('other_expense',10,2)->nullable();
            $table->double('net_profit',10,2)->nullable();
            $table->integer('total_profit_member')->nullable();

            $table->string('created_by',3)->nullable();
            $table->string('updated_by',3)->nullable();
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
        Schema::dropIfExists('profit_distribute');
    }
}
