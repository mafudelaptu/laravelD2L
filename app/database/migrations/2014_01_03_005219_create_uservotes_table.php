<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUservotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uservotes', function(Blueprint $table) {
			$table->bigInteger('user_id');
			$table->bigInteger('vote_of_user');
			$table->integer('votetype_id');
			$table->integer('match_id');
			$table->timestamps();

			$table->primary("user_id");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('uservotes');
	}

}
