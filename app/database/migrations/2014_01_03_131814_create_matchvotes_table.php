<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchvotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matchvotes', function(Blueprint $table) {
			$table->bigInteger('user_id');
			$table->integer('match_id');
			$table->bigInteger('vote_for_user');
			$table->integer('matchvotetype_id');
			$table->timestamps();

			$table->primary(array("user_id", "matchvotetype_id", "match_id", "vote_for_user"), "test_identifier");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matchvotes');
	}

}
