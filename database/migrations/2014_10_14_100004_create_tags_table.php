<?php
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tags', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('article_tag', function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('article_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary([
                'article_id',
                'tag_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_tags');
        Schema::drop('article_tag');
    }
}
