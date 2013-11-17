<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBanlistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banlists', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('user_id');
			$table->timestamp('banned_until');
			$table->integer('banlistreason_id');
			$table->integer('display');
			$table->bigInteger('bannedBy');
			$table->text('reason');
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
		Schema::drop('banlists');
	}

}
