<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnerLogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('winner_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->index();
            $table->string('phone');
            $table->integer('gift_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('winner_logs');
    }

}
