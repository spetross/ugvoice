<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrationUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('username')->nullable();
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->boolean('verified')->default(0);
            $table->string('verification_code')->nullable();
            $table->boolean('active')->default(0);
            $table->datetime('last_active_time')->nullable()->default(null);
            $table->timestamp('last_login')->nullable();
            $table->boolean('activated')->default(false);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('genre', ['male', 'female'])->nullable();
            $table->text('bio')->nullable();
            $table->text('profile_details')->nullable();
            $table->text('privacy_info')->nullable();
            $table->integer('organisation_id', false, true)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // We'll need to ensure that MySQL uses the InnoDB engine to
            // support the indexes, other engines aren't affected.
            $table->engine = 'InnoDB';
            $table->unique('email');
            $table->unique('username');
            $table->index('verification_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
