<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganisationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email');
            $table->string('cc_email')->nullable();
            $table->string('website')->nullable();
            $table->string('mission')->nullable();
            $table->text('objectives');
            $table->text('description');
            $table->string('phone', 25)->nullable();
            $table->string('cc_phone', 25)->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('country')->nullable();
            $table->text('address');
            $table->integer('created_by', false, true)->nullable();
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
        Schema::drop('organisations');
    }
}
