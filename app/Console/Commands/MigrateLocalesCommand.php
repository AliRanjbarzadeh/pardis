<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateLocalesCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'migrate:locales {--rollback : Rollback migrations}
											{--fresh : Fresh migrations}
											{--yes : Run migration anyway}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run migration for available locales and database existence';

	protected $skipConfirmation = false;

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		if ($this->option('yes')) {
			$this->skipConfirmation = true;
		}

		if ($this->option("rollback")) {
			$this->rollback();
		} else if ($this->option("fresh")) {
			$this->fresh();
		} else {
			$this->migrate();
		}
	}

	public function migrate(): void
	{
		if ($this->skipConfirmation) {
			$this->doMigration();
		} else if ($this->confirm("Are yoy sure to run migration for all databases? [yes|no]")) {
			$this->doMigration();
		}
	}

	private function doMigration(): void
	{
		$locales = config('app.available_locales');
		foreach ($locales as $locale) {
			$this->components->info("Running migration for $locale");
			$options = ['--force' => true, '--database' => "mysql_$locale"];
			if ($locale == 'fa') {
				$options['--database'] = "mysql";
			}

			//set telescope migration connection if telescope exists
			config(['telescope.storage.database.connection' => $options['--database']]);

			$this->call('migrate', $options);
			$this->newLine();
		}
	}

	public function rollback(): void
	{
		if ($this->skipConfirmation) {
			$this->doRollback();
		} else if ($this->confirm("Are yoy sure to rollback migrations for all databases? [yes|no]")) {
			$this->doRollback();
		}
	}

	private function doRollback(): void
	{
		$locales = config('app.available_locales');
		foreach ($locales as $locale) {
			$this->components->info("Rollback migration for $locale");
			$options = ['--force' => true, '--database' => "mysql_$locale"];
			if ($locale == 'fa') {
				$options['--database'] = "mysql";
			}

			//set telescope migration connection if telescope exists
			config(['telescope.storage.database.connection' => $options['--database']]);

			$this->call('migrate:rollback', $options);
			$this->newLine();
		}
	}

	public function fresh(): void
	{
		if ($this->skipConfirmation) {
			$this->doFresh();
		} else if ($this->confirm("Are yoy sure to fresh migrations for all databases? [yes|no]")) {
			$this->doFresh();
		}
	}

	private function doFresh(): void
	{
		$locales = config('app.available_locales');
		foreach ($locales as $locale) {
			$this->components->info("Fresh migration for $locale");
			$options = ['--force' => true, '--database' => "mysql_$locale"];
			if ($locale == 'fa') {
				$options['--database'] = "mysql";
			}

			//set telescope migration connection if telescope exists
			config(['telescope.storage.database.connection' => $options['--database']]);

			$this->call('migrate:fresh', $options);
			$this->newLine();
		}
	}
}
