<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('accounts', function(Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('idcard')->index();
            $table->string('phone');
            $table->string('name');
            $table->integer('win_count')->default(0);
            $table->integer('chance_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('accounts');
    }

}
