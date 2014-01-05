<?php

class PointtypesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('pointtypes')->truncate();

		$pointtypes = array(
			array("name"=>"Match-Win", "active"=>1, "created_at"=>new DateTime, "updated_at" => new DateTime),
			array("name"=>"Match-Lose", "active"=>1, "created_at"=>new DateTime, "updated_at" => new DateTime),
			array("name"=>"Punishment", "active"=>1, "created_at"=>new DateTime, "updated_at" => new DateTime),
			array("name"=>"Reward", "active"=>1, "created_at"=>new DateTime, "updated_at" => new DateTime),
			array("name"=>"Leave", "active"=>1, "created_at"=>new DateTime, "updated_at" => new DateTime),
			array("name"=>"Bonus", "active"=>1, "created_at"=>new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		 DB::table('pointtypes')->insert($pointtypes);
	}

}
