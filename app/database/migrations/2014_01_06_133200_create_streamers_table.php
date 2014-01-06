<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStreamersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('streamers', function(Blueprint $table) {
			$table->string('channelname');
			$table->bigInteger('linked_to_user');
			$table->string('lang');
			$table->timestamps();

			$table->primary("channelname");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('streamers');
	}

}
