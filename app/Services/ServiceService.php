<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\MediaDto;
use App\DataTransferObjects\ServiceDto;
use App\Exceptions\MediaException;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$services = Service::query()
			->regexpSearch($dto->term, ['title'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->orderBy('priority');

		$customActions = [
			//comments
			[
				'title' => __('admin/comment.plural'),
				'url' => 'admin.services.comments.index',
				'icon' => 'bx bx-message-square-dots text-primary',
				'isButton' => false,
			],
		];

		return $this->datatableService->datatable(
			query: $services,
			name: 'services',
			hasPriority: true
		)->toJson();
	}

	public function store(ServiceDto $dto): ?Service
	{
		try {
			DB::beginTransaction();

			$service = Service::create($dto->toArray());

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$service->upload($dto->featureImage, 'featureImage');
			}

			//icon image
			if (!is_null($dto->iconImage) && $dto->iconImage->isValid()) {
				$service->upload($dto->iconImage, 'iconImage');
			}

			//save seo items
			$service->saveSeoInformation($dto->seo);

			//faqs
			if (!is_null($dto->faqs)) {
				$service->addFaqs($dto->faqs);
			}

			//save media
			if (!is_null($dto->media)) {
				try {
					$service->addMedia($dto->media);
				} catch (MediaException $e) {
				}
			}

			DB::commit();

			return $service;
		} catch (\Exception $ex) {
			DB::rollBack();
			Log::error($ex->getMessage(), $ex->getTrace());
			return null;
		}
	}

	public function update(Service $service, ServiceDto $dto): bool
	{
		try {
			DB::beginTransaction();

			//update
			$service->update($dto->toArray());

			$media = collect();

			//feature image
			$featureImage = $service->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$service->removeMedia($featureImage->id);
				}
				$featureImage = $service->upload($dto->featureImage, 'featureImage');
			}
			if (!is_null($featureImage)) {
				$media->push(new MediaDto(mediumId: $featureImage->id, name: 'featureImage'));
			}

			//icon image
			$iconImage = $service->getMediumByName('iconImage');
			if (!is_null($dto->iconImage) && $dto->iconImage->isValid()) {
				if (!is_null($iconImage)) {
					$service->removeMedia($iconImage->id);
				}
				$iconImage = $service->upload($dto->iconImage, 'iconImage');
			}
			if (!is_null($iconImage)) {
				$media->push(new MediaDto(mediumId: $iconImage->id, name: 'iconImage'));
			}

			//merge media
			if (!is_null($dto->media)) {
				$media = $media->merge($dto->media);
			}

			//update media
			$service->updateMedia($media);

			//save seo items
			$service->updateSeoInformation($dto->seo);

			//faqs
			if (!is_null($dto->faqs)) {
				$service->updateFaqs($dto->faqs);
			} else {
				$service->deleteFaqs([]);
			}

			DB::commit();

			return true;
		} catch (\Exception|MediaException $ex) {
			DB::rollBack();
			Log::error($ex->getMessage(), $ex->getTrace());
			return false;
		}
	}

	/**
	 * @param int $limit
	 * @param array $orderBy
	 * @param array $relations
	 *
	 * @return Collection|array|Service[]
	 */
	public function all(int $limit = 0, array $orderBy = ['priority', 'asc'], array $relations = []): Collection|array
	{
		$services = Service::query();

		if (!empty($relations)) {
			$services->with($relations);
		}

		if ($limit > 0) {
			$services->limit($limit);
		}

		$services->orderBy($orderBy[0], $orderBy[1]);

		return $services->get();
	}

	public function findByLink(string $link): ?Service
	{
		return Service::whereHas('seo', function ($query) use ($link) {
			$query->where('link', '=', $link);
		})->with([
			'seo', 'media',
		])->first();
	}
}