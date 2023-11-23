<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeLanguageCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:language {file_name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make language file for the name given';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		if (!$this->hasArgument('file_name')) {
			$this->error("File name is required to create language file");
			return false;
		}

		$paths = explode('/', $this->argument('file_name'));
		$fileName = array_pop($paths);

		$path = implode('/', $paths);
		if (!File::isDirectory(lang_path($path))) {
			File::makeDirectory(path: lang_path($path), recursive: true);
		}

		if (File::exists(lang_path("$path/$fileName.php"))) {
			$this->error('Language file already exists');
			return false;
		}

		if (!File::exists($this->getStubPath())) {
			$this->error('Language stub file not founded');
			return false;
		}

		$content = $this->getStubContent($this->getStubPath());
		if (!$content) {
			$this->error('Failed to read stub');
			return false;
		}

		File::put($this->getSourcePath($this->argument('file_name')), $content);

		$this->components->info('Language file for the given name created successfully.');

		return true;
	}

	public function getStubPath(): string
	{
		return base_path('stubs/language.stub');
	}

	public function getStubContent(string $stub): bool|string
	{
		return file_get_contents($stub);
	}

	public function getSourcePath($fileName): string
	{
		return lang_path($fileName . '.php');
	}
}
