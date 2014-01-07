<?php

class BanlistreasonsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('banlistreasons')->truncate();

		$banlistreasons = array(
				array("name" => "automatically by Credit-System", "created_at" => new DateTime, "updated_at" => new DateTime),
				array("name" => "by Admin", "created_at" => new DateTime, "updated_at" => new DateTime),
				array("name" => "collected 6 active Warns", "created_at" => new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		DB::table('banlistreasons')->insert($banlistreasons);
	}

}
