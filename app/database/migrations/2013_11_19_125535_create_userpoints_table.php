<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserpointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userpoints', function(Blueprint $table) {
			$table->bigInteger('user_id');
			$table->integer('matchmode_id');
			$table->integer('matchtype_id');
			$table->integer('match_id');
			$table->integer('pointstype_id');
			$table->integer('event_id');
			$table->string('pointschange');
			$table->timestamps();

			$table->primary(array("user_id", "match_id", "pointstype_id", "event_id"));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('userpoints');
	}

}
