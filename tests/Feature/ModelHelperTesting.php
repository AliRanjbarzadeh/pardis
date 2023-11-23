<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Model;

trait ModelHelperTesting
{
	public function testInsertData(): void
	{
		$model = $this->model();
		$table = $model->getTable();

		$data = $model::factory()->make()->setAppends([])->toArray();

		$model::create($data);

		$this->assertDatabaseHas($table, $data);
	}

	abstract protected function model(): Model;
}