<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DoAllCronjobs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cronjob:doAllCronjobs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Do all cronjobs';

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
		$cmc = new CronjobDoAllController;
		$ret = $cmc->doAllCronjobs();
		$this->info($ret);
	}
}