<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->nullable();
            $table->integer('mobile')->nullable();
            $table->string('member_id',255)->nullable();
            $table->string('national_id',255)->nullable();
            $table->string('f_h_name',255)->nullable();
            $table->string('nominee',255)->nullable();
            $table->integer('nominee_mobile')->nullable();
            $table->string('nominee_n_id',255)->nullable();
            $table->text('present_address')->nullable();
            $table->text('parmanent_address')->nullable();
            
            $table->string('image_link',128)->nullable();

            $table->enum('type',array('Admin','Chairman','General secretary','Member'))->nullable();
            $table->enum('religion',array('Islam','Hinduism','Christianity','Buddhism'))->nullable();
            $table->enum('gender',array('Male','Female','Others'))->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
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
        Schema::dropIfExists('news');
    }
}
