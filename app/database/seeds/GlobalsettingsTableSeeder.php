<?php

class GlobalsettingsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('globalsettings')->truncate();

		$globalsettings = array(
			array("name" => "BasePoints","value" => "1200","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "DefaultRegion","value" => "1","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "DuoJoin","value" => "","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "justCM","value" => "","active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		DB::table('globalsettings')->truncate();
		DB::table('globalsettings')->insert($globalsettings);
	}

}
