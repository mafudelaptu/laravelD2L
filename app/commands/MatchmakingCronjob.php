<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MatchmakingCronjob extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cronjob:matchmaking';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Do matchmaking Cronjob';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$cmc = new CronjobMatchmakingController;
		$ret = $cmc->doMatchmaking();
		$this->info($ret);
	}
}