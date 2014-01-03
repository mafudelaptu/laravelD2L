<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsernotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usernotifications', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('user_id');
			$table->integer('notificationtype_id');
			$table->text('text');
			$table->text('href');
			$table->bigInteger('created_by');
			$table->integer('checked');
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
		Schema::drop('usernotifications');
	}

}
