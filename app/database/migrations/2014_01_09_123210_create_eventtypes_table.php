<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventtypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventtypes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('matchmode_id');
			$table->integer('matchtype_id');
			$table->integer('tournamenttype_id');
			$table->text('description');
			$table->integer('min_submissions');
			$table->string('start_time');
			$table->string('start_day');
			$table->integer('region_id');
			$table->integer('active');
			$table->integer('prizetype_id');
			$table->integer('eventrequirement_id');
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
		Schema::drop('eventtypes');
	}

}
