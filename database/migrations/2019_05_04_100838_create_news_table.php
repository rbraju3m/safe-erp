<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('title',255);
            $table->string('slug',100)->unique()->nullable();
            $table->string('excerpt',255)->nullable();
            $table->text('discription')->nullable();
            $table->integer('short_order')->nullable();
            $table->string('image_link',128)->nullable();
            $table->string('is_feature',32);

            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();
            $table->engine= 'InnoDB';

            $table->foreign('category_id')
                  ->references('id')->on('category')
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
        Schema::dropIfExists('news');
    }
}
