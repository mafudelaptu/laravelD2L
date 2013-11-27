<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsercreditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usercredits', function(Blueprint $table) {
			$table->bigInteger('user_id');
			$table->bigInteger('voted_by_user_id');
			$table->integer('match_id');
			$table->integer('vote');
			$table->timestamps();

			$table->primary("user_id", "voted_by_user_id", "match_id");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usercredits');
	}

}
