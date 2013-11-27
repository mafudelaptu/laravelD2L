<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchedUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matched_users', function(Blueprint $table) {
			$table->increments('id');
			$table->interger('match_id');
			$table->bigInteger('user_id');
			$table->integer('team_id');
			$table->integer('points');
			$table->integer('ready');
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
		Schema::drop('matched_users');
	}

}
