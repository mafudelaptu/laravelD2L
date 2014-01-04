<?php

use Illuminate\Database\Migrations\Migration;

class AddPrimaryKeysToUsercredits extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usercredits', function($table)
		{
			$table->dropPrimary("user_id");
			$table->primary(array("user_id", 'match_id', "voted_by_user_id"));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usercredits', function($table)
		{
			$table->dropPrimary("voted_by_user_id");
			$table->dropPrimary("match_id");
			$table->primary("user_id");
		});
	}

}