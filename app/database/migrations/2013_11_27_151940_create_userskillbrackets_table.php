<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserskillbracketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userskillbrackets', function(Blueprint $table) {
			$table->bigInteger('user_id');
			$table->integer('matchtype_id');
			$table->integer('skillbrackettype_id');
			$table->integer('skillbracket_before');
			$table->timestamp('last_check');
			$table->timestamps();

			$table->primary(array("user_id", "matchtype_id"));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('userskillbrackets');
	}

}
