<?php

class GlobalsettingsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('globalsettings')->truncate();

		$globalsettings = array(
			array("name" => "BasePoints","value" => "1200","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "DefaultRegion","value" => "1","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "DuoJoin","value" => "","active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "justCM","value" => "","active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "QueueLockTime","value" => "180","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "WeeklyUpvoteCount","value" => "10","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "WeeklyDownvoteCount","value" => "5","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "CreditBronzeBorder","value" => "25","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "CreditSilverBorder","value" => "125","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "CreditGoldBorder","value" => "250","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "MatchLeaverPunishment","value" => "-50","active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "QuickJoinMatchmode","value" => 9,"active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "BanCreditBorder","value" => -15,"active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "WeeklyVoteCountUpdateDay","value" => 1,"active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
			array("name" => "PermaBanBorder","value" => 6,"active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime),
		);

		// Uncomment the below to run the seeder
		DB::table('globalsettings')->truncate();
		DB::table('globalsettings')->insert($globalsettings);
	}

}
