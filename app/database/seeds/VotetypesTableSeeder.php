<?php

class VotetypesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('votetypes')->truncate();

		$votetypes = array(
			array("name" => "Upvote", "weight" => "2", "created_at" => new DateTime(), "updated_at" => new DateTime()),
			array("name" => "Downvote", "weight" => "-2", "created_at" => new DateTime(), "updated_at" => new DateTime()),
		);

		// Uncomment the below to run the seeder
		 DB::table('votetypes')->insert($votetypes);
	}

}
