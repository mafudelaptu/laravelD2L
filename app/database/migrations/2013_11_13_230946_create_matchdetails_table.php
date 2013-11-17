<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchdetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matchdetails', function(Blueprint $table) {
			$table->integer('match_id');
			$table->biginteger('user_id');
			$table->integer('submitted');
			$table->integer('team_id');
			$table->integer('screenshot');
			$table->timestamp('screenshot_at');
			$table->integer('submissionFor');
			$table->timestamp('sub_date');
			$table->integer('elo');
			$table->integer('group_id');

			$table->primary(array("match_id", "user_id"));
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matchdetails');
	}

}
