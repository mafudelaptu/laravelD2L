<?php

use Illuminate\Database\Migrations\Migration;

class ChangeColumnPointstypeToPointtypeUserpointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('userpoints', function($table)
		{
			$table->renameColumn('pointstype_id', 'pointtype_id');
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
				$table->renameColumn('pointtype_id', 'pointstype_id');
		});
	}

}