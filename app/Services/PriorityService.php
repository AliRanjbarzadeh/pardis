<?php

namespace App\Services;

use App\DataTransferObjects\PriorityDto;
use Exception;
use Illuminate\Support\Facades\Log;

class PriorityService
{
	public function update(PriorityDto $dto): bool
	{
		try {
			$model = $dto->model;
			foreach ($dto->priorities as $priority) {
				$model::where('id', '=', $priority['id'])
					->update([
						'priority' => $priority['priority'],
					]);
			}

			return true;
		} catch (Exception $e) {
			Log::error($e->getMessage(), $e->getTrace());
			return false;
		}
	}
}