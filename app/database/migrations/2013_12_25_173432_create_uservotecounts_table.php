<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUservotecountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('uservotecounts', function(Blueprint $table) {
			$table->bigInteger('user_id')->primary("user_id");
			$table->integer('upvotes');
			$table->integer('downvotes');
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
		Schema::drop('uservotecounts');
	}

}
