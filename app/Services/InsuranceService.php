<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\InsuranceDto;
use App\Exceptions\MediaException;
use App\Models\Insurance;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InsuranceService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	/**
	 * @param DatatablesFilterDto $dto
	 *
	 * @return JsonResponse
	 */
	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$insurances = Insurance::regexpSearch($dto->term, ['name'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->with('media')
			->newQuery();

		return $this->datatableService->datatable($insurances, 'insurances')
			->addColumn('image', function (Insurance $insurance) {
				return '<img class="w-px-50" src="' . $insurance->getMediumByName('featureImage')->thumbnail . '" >';
			})
			->toJson();
	}

	/**
	 * @param InsuranceDto $dto
	 *
	 * @return Insurance|null
	 */
	public function store(InsuranceDto $dto): ?Insurance
	{
		try {
			DB::beginTransaction();

			$insurance = Insurance::create($dto->toArray());

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$insurance->upload($dto->featureImage, 'featureImage');
			}

			//categories
			if (!is_null($dto->categories)) {
				$insurance->categories()->attach($dto->categories);
			}

			DB::commit();

			return $insurance;
		} catch (Exception|MediaException $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	/**
	 * @param Insurance $insurance
	 * @param InsuranceDto $dto
	 *
	 * @return bool
	 */
	public function update(Insurance $insurance, InsuranceDto $dto): bool
	{
		try {
			DB::beginTransaction();

			//update
			$insurance->update($dto->toArray());

			//feature image
			$featureImage = $insurance->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$insurance->removeMedia($featureImage->id);
				}
				$insurance->upload($dto->featureImage, 'featureImage');
			}

			//categories
			if (!is_null($dto->categories)) {
				$insurance->categories()->sync($dto->categories);
			}

			DB::commit();

			return true;
		} catch (Exception|MediaException $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return false;
		}
	}

	/**
	 * @param int $limit
	 * @param array $orderBy
	 * @param array $relations
	 *
	 * @return Collection|array|Insurance[]
	 */
	public function all(int $limit = 0, array $orderBy = ['name', 'asc'], array $relations = []): Collection|array
	{
		$insurances = Insurance::query();

		if (!empty($relations)) {
			$insurances->with($relations);
		}

		if ($limit > 0) {
			$insurances->limit($limit);
		}

		$insurances->orderBy($orderBy[0], $orderBy[1]);

		return $insurances->get();
	}
}