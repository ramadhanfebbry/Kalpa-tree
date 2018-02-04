<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function(Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('user_id');
            $table->string('title');
            $table->string('promo');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('picture');
            $table->string('description');
            $table->string('date_start');
            $table->string('date_end');
            $table->smallInteger('quantity');
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
        Schema::drop('promos');
    }
}
