<?php

namespace App\Services;

use App\DataTransferObjects\ClinicDto;
use App\DataTransferObjects\ContactDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\MediaDto;
use App\Exceptions\InsuranceItemException;
use App\Exceptions\MediaException;
use App\Models\Clinic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClinicService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$clinics = Clinic::query()
			->regexpSearch($dto->term, ['title', 'description'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		return $this->datatableService->datatable(
			query: $clinics,
			name: 'clinics',
			hasPriority: true
		)->toJson();
	}

	public function store(ClinicDto $dto): ?Clinic
	{
		try {
			DB::beginTransaction();

			$clinic = Clinic::create($dto->forCreate());

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$clinic->upload($dto->featureImage, 'featureImage');
			}

			//save contact information
			if (!is_null($dto->contacts)) {
				$clinic->contacts()->createMany($dto->contacts->map(function (ContactDto $dto) {
					return $dto->forCreate();
				})->all());
			}

			//save seo
			$clinic->saveSeoInformation($dto->seo);

			//save media
			if (!is_null($dto->media)) {
				$clinic->addMedia($dto->media);
			}

			//insurances
			if (!is_null($dto->insurances)) {
				$clinic->addInsurances($dto->insurances);
			}

			DB::commit();

			return $clinic;
		} catch (InsuranceItemException|MediaException $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Clinic $clinic, ClinicDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$clinic->update($dto->forCreate());

			$media = collect();

			//feature image
			$featureImage = $clinic->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$clinic->removeMedia($featureImage->id);
				}
				$featureImage = $clinic->upload($dto->featureImage, 'featureImage');
			}
			$media->push(new MediaDto(mediumId: $featureImage->id, name: 'featureImage'));

			//merge media
			if (!is_null($dto->media)) {
				$media = $media->merge($dto->media);
			}

			//update media
			$clinic->updateMedia($media);

			//save contact information
			if (!is_null($dto->contacts)) {
				$currentContacts = $dto->contacts->where('id', '>', 0)->collect();
				if ($currentContacts->isNotEmpty()) {
					$clinic->contacts()->whereNotIn('id', $currentContacts->pluck('id')->toArray())->delete();

					$currentContacts->map(function (ContactDto $dto) use ($clinic) {
						$clinic->contacts
							->where('id', '=', $dto->id)
							->first()
							->update($dto->forCreate());
					});
				} else {
					$clinic->contacts()->delete();
				}

				$newItems = $dto->contacts->where('id', '=', 0)->collect();
				if ($newItems->isNotEmpty()) {
					$clinic->contacts()->createMany($newItems->map(function (ContactDto $dto) {
						return $dto->forCreate();
					})->all());
				}
			} else {
				$clinic->contacts()->delete();
			}

			//save seo
			$clinic->updateSeoInformation($dto->seo);

			//insurances
			if (!is_null($dto->insurances)) {
				$clinic->updateInsurances($dto->insurances);
			}

			DB::commit();

			return true;
		} catch (InsuranceItemException|MediaException $e) {
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
	 * @return Collection|array|Clinic[]
	 */
	public function all(int $limit = 0, array $orderBy = ['priority', 'asc'], array $relations = []): Collection|array
	{
		$clinics = Clinic::query();

		if (!empty($relations)) {
			$clinics->with($relations);
		}

		if ($limit > 0) {
			$clinics->limit($limit);
		}

		$clinics->orderBy($orderBy[0], $orderBy[1]);

		return $clinics->get();
	}

	public function paginated(int $perPage, ?string $term = null): LengthAwarePaginator
	{
		$clinics = Clinic::with([
			'media',
			'seo',
		]);

		$clinics->regexpSearch($term, ['title', 'description']);

		return $clinics->paginate($perPage)->withQueryString();
	}

	public function findByLink(string $link): ?Clinic
	{
		return Clinic::whereHas('seo', function ($query) use ($link) {
			$query->where('link', '=', $link);
		})->with([
			'seo', 'media', 'contacts', 'doctors', 'insurances',
		])->first();
	}
}