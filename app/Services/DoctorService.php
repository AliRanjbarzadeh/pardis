<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\DoctorDto;
use App\DataTransferObjects\MediaDto;
use App\DataTransferObjects\MetaDto;
use App\DataTransferObjects\ResumeDto;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$doctors = Doctor::query()
			->regexpSearch($dto->term, ['first_name', 'last_name'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		$customActions = [
			//comments
			[
				'title' => __('admin/comment.plural'),
				'url' => 'admin.doctors.comments.index',
				'icon' => 'bx bx-message-square-dots text-primary',
				'isButton' => false,
			],
		];

		return $this->datatableService->datatable(
			query: $doctors,
			name: 'doctors',
			customActions: $customActions,
			hasPriority: true
		)->toJson();
	}

	public function store(DoctorDto $dto): ?Doctor
	{
		try {
			DB::beginTransaction();

			$doctor = Doctor::create($dto->forCreate());

			//speciality
			$doctor->specialities()->attach($dto->specialityId);

			//clinics
			if (!is_null($dto->clinics)) {
				$doctor->clinics()->attach($dto->clinics);
			}

			//resumes
			if (!is_null($dto->resumes)) {
				$doctor->addMetas(new MetaDto(metaKey: 'resumes', metaValue: $this->parseResumes($dto->resumes)));
			}

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$doctor->upload($dto->featureImage, 'featureImage');
			}

			//save contact information
			if (!is_null($dto->contacts)) {
				$doctor->addContacts($dto->contacts);
			}

			//save seo
			$doctor->saveSeoInformation($dto->seo);

			//save media
			if (!is_null($dto->media)) {
				$doctor->addMedia($dto->media);
			}

			//insurances
			if (!is_null($dto->insurances)) {
				$doctor->addInsurances($dto->insurances);
			}

			//social networks
			if (!is_null($dto->socialNetworks)) {
				$doctor->addSocialNetworks($dto->socialNetworks);
			}

			DB::commit();

			return $doctor;
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Doctor $doctor, DoctorDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$doctor->update($dto->forCreate());

			//speciality
			$doctor->specialities()->sync([$dto->specialityId]);

			//clinics
			$doctor->clinics()->sync($dto->clinics);

			//resumes
			if (!is_null($dto->resumes)) {
				if ($doctor->hasMeta('resumes')) {
					$doctor->updateMetas(new MetaDto(metaKey: 'resumes', metaValue: $this->parseResumes($dto->resumes), id: $doctor->getMetaId('resumes')));
				} else {
					$doctor->addMetas(new MetaDto(metaKey: 'resumes', metaValue: $this->parseResumes($dto->resumes)));
				}
			} else {
				$doctor->deleteMeta('resumes');
			}

			$media = collect();

			//feature image
			$featureImage = $doctor->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$doctor->removeMedia($featureImage->id);
				}
				$featureImage = $doctor->upload($dto->featureImage, 'featureImage');
			}
			$media->push(new MediaDto(mediumId: $featureImage->id, name: 'featureImage'));

			//merge media
			if (!is_null($dto->media)) {
				$media = $media->merge($dto->media);
			}

			//update media
			$doctor->updateMedia($media);

			//save contact information
			if (!is_null($dto->contacts)) {
				$doctor->updateContacts($dto->contacts);
			} else {
				$doctor->deleteContacts([]);
			}

			//save seo
			$doctor->updateSeoInformation($dto->seo);

			//insurances
			if (!is_null($dto->insurances)) {
				$doctor->updateInsurances($dto->insurances);
			}

			//social networks
			if (!is_null($dto->socialNetworks)) {
				$doctor->updateSocialNetworks($dto->socialNetworks);
			}

			DB::commit();

			return true;
		} catch (\Exception $e) {
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
	 * @return Collection|array|Doctor[]
	 */
	public function all(int $limit = 0, array $orderBy = ['priority', 'asc'], array $relations = []): Collection|array
	{
		$doctors = Doctor::query();

		if (!empty($relations)) {
			$doctors->with($relations);
		}

		if ($limit > 0) {
			$doctors->limit($limit);
		}

		$doctors->orderBy($orderBy[0], $orderBy[1]);

		return $doctors->get();
	}

	private function parseResumes(Collection $resumes): array
	{
		return $resumes->map(function (ResumeDto|array $item) {
			if (is_array($item)) {
				return $item;
			}

			return $item->toArray();
		})->all();
	}

	public function paginated(int $perPage, ?string $term = null, ?Speciality $speciality = null): LengthAwarePaginator
	{
		$doctors = Doctor::with([
			'media',
			'seo',
			'specialities',
		])->orderBy('priority')->latest();

		$doctors->regexpSearch($term, ['first_name', 'last_name', 'description']);

		if (!is_null($speciality)) {
			$doctors->whereHas('specialities', function ($query) use ($speciality) {
				$query->where('specialities.id', '=', $speciality->id);
			});
		}

		return $doctors->paginate($perPage)->withQueryString();
	}
}