<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('sex', ['Мужской', 'Женский'])->nullable();
            $table->string('screen_name')->nullable();
            $table->text('photo_max_orig')->nullable();
            $table->text('photo_200')->nullable();
            $table->text('status')->nullable();
            $table->string('university_name')->nullable();
            $table->text('quotes')->nullable();
            $table->enum('liker', [0, 1])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
