<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermabansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permaBans', function(Blueprint $table) {
			$table->bigInteger('user_id')->primary("user_id");
			$table->integer('banlistreason_id');
			$table->timestamp('banned_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permaBans');
	}

}
