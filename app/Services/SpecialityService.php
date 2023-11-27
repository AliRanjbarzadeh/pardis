<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\SpecialityDto;
use App\Models\Speciality;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpecialityService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$specialities = Speciality::query()
			->regexpSearch($dto->term, ['title', 'description'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		return $this->datatableService->datatable(
			query: $specialities,
			name: 'specialities'
		)->toJson();
	}

	public function store(SpecialityDto $dto): ?Speciality
	{
		try {
			DB::beginTransaction();

			$speciality = Speciality::create($dto->toArray());

			//seo
			$speciality->saveSeoInformation($dto->seo);

			DB::commit();

			return $speciality;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Speciality $speciality, SpecialityDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$speciality->update($dto->toArray());

			//seo
			$speciality->updateSeoInformation($dto->seo);

			DB::commit();

			return true;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return false;
		}
	}

	/**
	 * @return Collection|array|Speciality[]
	 */
	public function all(): Collection|array
	{
		return Speciality::with('seo')->orderBy('name')->get();
	}
}