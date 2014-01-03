<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeVotetypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('votetypes', function($table)
		{
			$table->dropColumn('active');
			$table->integer('weight');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('votetypes', function($table)
		{
			$table->integer('active');
			$table->dropColumn('weight');
		});

	}

}
