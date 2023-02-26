<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfitDistributeMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_distribute_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profit_id');
            $table->unsignedBigInteger('member_id');

            $table->double('deposit_amount',10,2)->nullable();
            $table->double('profit_amount',10,2)->nullable();

            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('member_id')
                ->references('id')->on('member')
                ->onDelete('cascade');
            $table->foreign('profit_id')
                ->references('id')->on('profit_distribute')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profit_distribute_member');
    }
}
