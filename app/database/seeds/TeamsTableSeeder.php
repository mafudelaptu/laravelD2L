<?php

class TeamsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('teams')->truncate();

		$teams = array(
			array("name"=>"The Radiant", "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name"=>"The Dire", "created_at" => new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		 DB::table('teams')->insert($teams);
	}

}
