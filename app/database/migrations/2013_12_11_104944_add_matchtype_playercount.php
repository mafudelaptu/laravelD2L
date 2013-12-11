<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMatchtypePlayercount extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matchtypes', function(Blueprint $table) {
			$table->integer('playercount');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matchtypes', function(Blueprint $table) {
			$table->dropColumn('playercount');
		});
	}

}
