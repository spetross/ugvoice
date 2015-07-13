<?php
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('article_categories', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('article_category', function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('article_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary([
                'article_id',
                'category_id'
            ]);
        });
    }

    public function down()
    {
        Schema::drop('article_categories');
        Schema::drop('article_category');
    }
}
