<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillbrackettypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skillbrackettypes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('winpoints');
			$table->integer('losepoints');
			$table->integer('active');
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
		Schema::drop('skillbrackettypes');
	}

}
