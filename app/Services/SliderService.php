<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\SliderDto;
use App\Enums\SliderPageEnum;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SliderService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$sliders = Slider::query()
			->where('page', '=', SliderPageEnum::tryFrom($dto->type))
			->regexpSearch($dto->term, ['title', 'description'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		return $this->datatableService->datatable(
			query: $sliders,
			name: "$dto->type.sliders",
			hasPriority: true
		)->toJson();
	}

	public function store(SliderDto $dto): ?Slider
	{
		try {
			DB::beginTransaction();

			$slider = Slider::create($dto->toArray());

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$slider->upload($dto->featureImage, 'featureImage');
			}

			DB::commit();

			return $slider;
		} catch (\Exception $e) {
			DB::rollBack();
			return null;
		}
	}

	public function update(Slider $slider, SliderDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$slider->update($dto->toArray());

			//feature image
			$featureImage = $slider->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$slider->removeMedia($featureImage->id);
				}
				$slider->upload($dto->featureImage, 'featureImage');
			}

			DB::commit();

			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			return false;
		}
	}

	/**
	 * @param SliderPageEnum $page
	 *
	 * @return Collection|array|Slider[]
	 */
	public function all(SliderPageEnum $page): Collection|array
	{
		return Slider::where('page', '=', $page)
			->with('media')
			->orderBy('priority')
			->get();
	}
}