<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('GlobalsettingsTableSeeder');
		$this->call('MatchesTableSeeder');
		$this->call('QueuesTableSeeder');
		$this->call('MatchtypesTableSeeder');
		$this->call('MatchmodesTableSeeder');
		$this->call('MatchdetailsTableSeeder');
		$this->call('QueuelocksTableSeeder');
		$this->call('PermabansTableSeeder');
		$this->call('BanlistreasonsTableSeeder');
		$this->call('BanlistsTableSeeder');
		$this->call('VotetypesTableSeeder');
		$this->call('UserpointsTableSeeder');
	}

}