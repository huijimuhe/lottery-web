<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('gifts', function(Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->integer('grade');
            $table->integer('total')->default(999);
            $table->integer('surplus')->default(999);
            $table->integer('winner_count')->default(0);
            $table->double('rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('gifts');
    }

}
