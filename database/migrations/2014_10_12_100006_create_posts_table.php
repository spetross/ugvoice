<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id', false, true)->nullable()->index();
            $table->integer('organisation_id', false, true)->index();
            $table->enum('post_type', ['Link', 'Post'])->default('Post');
            $table->boolean('has_images')->default(false);
            $table->string('title')->nullable();
            $table->text('content');
            $table->string('link')->nullable();
            $table->boolean('private')->default(false);
            $table->boolean('hide_identity')->default(false);
            $table->softDeletes();
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
        Schema::drop('posts');
    }
}
