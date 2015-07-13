<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DbFiles extends Migration
{

    public function up()
    {

        Schema::create('files', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('disk_name');
            $table->string('file_name');
            $table->integer('file_size');
            $table->string('content_type');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('field')->nullable()->index();
            $table->morphs('attachable');
            $table->boolean('is_public')->default(true);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
