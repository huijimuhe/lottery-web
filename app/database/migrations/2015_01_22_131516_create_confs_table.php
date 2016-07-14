<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('confs', function(Blueprint $table) { 
            $table->increments('id');
            $table->string('param');
            $table->integer('val')->default(0); 
            $table->integer('val2')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('confs');
    }

}
