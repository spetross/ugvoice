<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('sender');
            $table->integer('receiver');
            $table->string('image')->nullable();
            $table->integer('conversation_id');
            $table->integer('sender_status')->default(0);
            $table->integer('receiver_status')->default(0);
            $table->integer('seen')->default(0);
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('thread_id')->references('id')->on('threads');
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }

}
