<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id', false, true)->index();
            $table->integer('organisation_id', false, true)->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tags')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->text('content_html')->nullable();
            $table->enum('status', ['published', 'draft', 'archived'])->default('draft');
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
