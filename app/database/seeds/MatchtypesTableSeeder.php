<?php

class MatchtypesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('matchtypes')->truncate();

		$matchtypes = array(
			array("name" => "5vs5 Single", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "1vs1", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "5vs5 Team", "active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		DB::table('matchtypes')->truncate();
		DB::table('matchtypes')->insert($matchtypes);
	}

}
