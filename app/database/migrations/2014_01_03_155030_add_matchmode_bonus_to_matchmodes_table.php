<?php

use Illuminate\Database\Migrations\Migration;

class AddMatchmodeBonusToMatchmodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matchmodes', function($table)
		{
			$table->integer("bonus");
			$table->integer("bonus_active");	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matchmodes', function($table)
		{
			$table->dropColumn("bonus");
			$table->dropColumn("bonus_active");
		});
	}

}