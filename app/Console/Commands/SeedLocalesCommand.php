<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedLocalesCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'seed:locales {name} {--yes : Run seed anyway}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run database seeder for locales';

	protected $skipConfirmation = false;

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		if ($this->option('yes')) {
			$this->skipConfirmation = true;
		}

		if (!$this->hasArgument('name')) {
			$this->error("Please enter seeder class name");
		} else {
			$this->seed();
		}
	}

	public function seed(): void
	{
		$seederClassName = $this->argument('name');
		if ($this->skipConfirmation) {
			$this->doSeed();
		} else if ($this->confirm("Are yoy sure to run $seederClassName seeder for all databases? [yes|no]")) {
			$this->doSeed();
		}
	}

	public function doSeed(): void
	{
		$seederClassName = $this->argument('name');
		$locales = config('app.available_locales');

		foreach ($locales as $locale) {
			$this->components->info("Running $seederClassName seeder for $locale");
			$options = [
				'--force' => true,
				'--database' => "mysql_$locale",
				'--class' => $seederClassName,
			];
			if ($locale == 'fa') {
				$options['--database'] = "mysql";
			}

			$this->call('db:seed', $options);
			$this->newLine();
		}
	}
}
