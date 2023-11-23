<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\GalleryDto;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GalleryService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$galleries = Gallery::query()
			->regexpSearch($dto->term, ['title'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->categorySearch($dto->categoryId)
			->with('categories');

		return $this->datatableService->datatable(
			query: $galleries,
			name: 'galleries',
			hasPriority: true
		)->toJson();
	}

	public function store(GalleryDto $dto): ?Gallery
	{
		try {
			DB::beginTransaction();

			$gallery = Gallery::create($dto->toArray());

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$gallery->upload($dto->featureImage, 'featureImage');
			}

			//seo
			$gallery->saveSeoInformation($dto->seo);

			//categories
			$gallery->categories()->attach($dto->categoryId);

			DB::commit();

			return $gallery;
		} catch (\Exception $e) {
			DB::rollBack();
			return null;
		}
	}

	public function update(Gallery $gallery, GalleryDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$gallery->update($dto->toArray());

			//feature image
			$featureImage = $gallery->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$gallery->removeMedia($featureImage->id);
				}
				$gallery->upload($dto->featureImage, 'featureImage');
			}

			//seo
			$gallery->updateSeoInformation($dto->seo);

			//categories
			$gallery->categories()->sync([$dto->categoryId]);

			DB::commit();

			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			return false;
		}
	}

	/**
	 * @return Collection|array|Gallery[]
	 */
	public function all(): Collection|array
	{
		return Gallery::with('media')
			->orderBy('priority')
			->get();
	}
}