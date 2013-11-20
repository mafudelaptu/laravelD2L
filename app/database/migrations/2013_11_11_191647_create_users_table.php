<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->bigInteger('id')->primary("id");
			$table->string('name');
			$table->string('avatar');
			$table->string('avatarFull');
			$table->integer('admin');
			$table->integer('basePoints');
			$table->integer('basePointsUpdatedTimestamp');
			$table->integer('resetStats');
			$table->integer("region_id");
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
		Schema::drop('users');
	}

}
