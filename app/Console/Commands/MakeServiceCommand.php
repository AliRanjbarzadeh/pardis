<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:service {model : Model name (Example: User)}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create service file for given name';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		if (!$this->hasArgument('model')) {
			$this->error("Model is required to create service file");
			return false;
		}

		$modelName = $this->argument('model');
		$serviceName = Str::ucfirst($modelName) . 'Service';

		if (File::exists(app_path('Services/' . $serviceName . '.php'))) {
			$this->error('Service file already exists');
			return false;
		}

		if (!File::exists(app_path('Models/' . $modelName . '.php'))) {
			$this->error('Model not exists');
			return false;
		}

		$content = $this->getStubContent($this->getStubPath());
		if (!$content) {
			$this->error('Failed to read stub');
			return false;
		}

		if (!File::exists($this->getDto($modelName . 'Dto'))) {
			$this->createDto($modelName);
		}

		$modelPlural = Str::plural(Str::lower($modelName));
		$modelVar = Str::lower($modelName);


		$content = Str::replace(['{{ model }}', '{{ model_plural }}', '{{ model_var }}'], [$modelName, $modelPlural, $modelVar], $content);;

		File::put($this->getSourcePath($serviceName), $content);

		$this->components->info('Service file for the given model created successfully.');

		return true;
	}

	public function getStubPath(): string
	{
		return base_path('stubs/service.stub');
	}

	public function getStubContent(string $stub): bool|string
	{
		return file_get_contents($stub);
	}

	public function getSourcePath($fileName): string
	{
		return app_path('Services/' . $fileName . '.php');
	}

	public function getDto($name): string
	{
		return app_path('DataTransferObjects/' . $name . '.php');
	}

	public function createDto($modelName): void
	{
		$dtoName = $modelName . 'Dto';
		$modelClass = '\\App\\Models\\' . $modelName;
		$model = new $modelClass;
		$table = $model->getTable();

		$columns = array_diff(Schema::getColumnListing($table), ['id', 'created_at', 'updated_at', 'deleted_at']);

		$content = $this->getStubContent($this->getDtoStubPath());

		$params = '';
		$paramsArray = '';
		foreach ($columns as $key => $column) {
			$params .= "public \$$column,";
			$paramsArray .= "'$column' => \$this->$column,";
			if ($key <= count($columns)) {
				$params .= "\n";
				$paramsArray .= "\n";
			}
		}
		$content = Str::replace(['{{ class }}', '{{ params }}', '{{ params_array }}'], [$modelName, $params, $paramsArray], $content);

		File::put($this->getDtoSourcePath($dtoName), $content);

		$this->components->info('Dto file for the given model created successfully.');
	}

	public function getDtoStubPath(): string
	{
		return base_path('stubs/dto.stub');
	}

	public function getDtoStubContent(string $stub): bool|string
	{
		return file_get_contents($stub);
	}

	public function getDtoSourcePath($fileName): string
	{
		return app_path('DataTransferObjects/' . $fileName . '.php');
	}
}
