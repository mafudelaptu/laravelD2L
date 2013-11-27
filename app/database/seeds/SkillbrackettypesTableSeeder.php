<?php

class SkillbrackettypesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('skillbrackettypes')->truncate();

		$skillbrackettypes = array(
			array("name"=>"Prison", "winpoints"=>5, "losepoints"=>5, "active"=>1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name"=>"Trainee", "winpoints"=>20, "losepoints"=>16, "active"=>1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name"=>"Amateur", "winpoints"=>20, "losepoints"=>18, "active"=>1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name"=>"Skilled", "winpoints"=>20, "losepoints"=>20, "active"=>1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name"=>"Expert", "winpoints"=>20, "losepoints"=>20, "active"=>1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name"=>"Master", "winpoints"=>20, "losepoints"=>20, "active"=>1, "created_at" => new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		DB::table('skillbrackettypes')->truncate();
		DB::table('skillbrackettypes')->insert($skillbrackettypes);
	}

}
