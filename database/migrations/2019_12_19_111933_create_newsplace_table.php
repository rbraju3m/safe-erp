<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsplace', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_id');
            $table->string('place')->nullable();
            $table->string('order')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('news_id')
                  ->references('id')->on('news')
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
        Schema::dropIfExists('newsplace');
    }
}
