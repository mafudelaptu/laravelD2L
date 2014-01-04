<?php

class MatchmodesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('matchmodes')->truncate();

		$matchmodes = array(
			array("name" => "All-Pick", "shortcut" => "AP", "descr" => "Each player is allowed to pick a hero of the whole hero-pool.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Single-Draft", "shortcut" => "SD", "descr" => "Each player chooses from one of 3 individual random heroes.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Captains-Mode", "shortcut" => "CM", "descr" => "The Dire and The Radiant take turns banning heroes, then take turns picking heroes. These heroes are then chosen by members of their team.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "All-Random, All-Mid", "shortcut" => "ARAM", "descr" => "", "active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Only Mid", "shortcut" => "OM", "descr" => "Only the middle lane is used.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Least Mode", "shortcut" => "LM", "descr" => "", "active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Random Draft", "shortcut" => "RD", "descr" => "20 random heroes from the hero-pool are selected and players take turns picking from them.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "All Random", "shortcut" => "AR", "descr" => "Each player is given a random hero from the hero-pool.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Captains Draft", "shortcut" => "CD", "descr" => "24 random heroes are selected. Then The Dire and The Radiant take turns banning heroes, then picking heroes. Then the players on each team pick from their team's heroes.", "active" => 1, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Easy Mode", "shortcut" => "EM", "descr" => "Towers are weaker, and players get extra gold and experience.", "active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			array("name" => "Death Match", "shortcut" => "DM", "descr" => "When you die you are given a new hero. The game can end normally, or when one team reaches a certain amount of deaths. lives # can be used to set life limit, and -nd to remove respawn timer along with this mode.", "active" => 0, "created_at" => new DateTime, "updated_at" => new DateTime,"bonus" => 0, "bonus_active" => 1),
			);

		// Uncomment the below to run the seeder
		DB::table('matchmodes')->truncate();
		DB::table('matchmodes')->insert($matchmodes);
}

}
