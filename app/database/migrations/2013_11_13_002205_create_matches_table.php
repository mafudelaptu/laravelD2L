<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('team_won_id');
			$table->integer('matchtype_id');
			$table->integer('matchmode_id');
			$table->integer('region_id');
			$table->integer('check');
			$table->integer('canceled');
			$table->timestamp('closed');
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
		Schema::drop('matches');
	}

}
