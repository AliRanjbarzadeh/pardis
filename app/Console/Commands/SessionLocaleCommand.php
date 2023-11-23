<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SessionLocaleCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'session:locales {--clean : Clear sessions}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear all sessions for all locales defined in config available locales';

	/**
	 * Execute the console command.
	 */
	public function handle(): void
	{
		if ($this->option('clean')) {
			$this->clearSessions();
		} else {
			$locales = config('app.available_locales');
			foreach ($locales as $locale) {
				$sessionPath = base_path("storage/framework/sessions/$locale");
				if (!File::exists($sessionPath)) {
					File::makeDirectory($sessionPath, 0775);
				}
			}
		}
	}

	protected function clearSessions(): void
	{
		$locales = config('app.available_locales');
		foreach ($locales as $locale) {
			$sessionPath = base_path("storage/framework/sessions/$locale");
			$allFiles = File::files($sessionPath);
			File::delete($allFiles);
		}
	}
}
