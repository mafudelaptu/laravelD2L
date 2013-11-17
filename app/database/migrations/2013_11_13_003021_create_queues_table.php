<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('queues', function(Blueprint $table) {

			$table->biginteger('user_id');
			$table->integer('matchtype_id');
			$table->integer('matchmode_id');
			$table->integer('region_id');
			$table->integer('rank');
			$table->integer('force_search');
			$table->timestamps();

			$table->primary(array("user_id", "matchtype_id", "matchmode_id", "region_id"));
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('queues');
	}

}
