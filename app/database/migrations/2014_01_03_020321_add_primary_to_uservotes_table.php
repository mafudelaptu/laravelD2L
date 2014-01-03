<?php

use Illuminate\Database\Migrations\Migration;

class AddPrimaryToUservotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('uservotes', function($table)
		{
			$table->dropPrimary("user_id");
			$table->primary(array("user_id", 'match_id', "vote_of_user"));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('uservotes', function($table)
		{
			$table->dropPrimary('match_id');
			$table->dropPrimary('vote_of_user');
			$table->primary("user_id");
		});
	}

}