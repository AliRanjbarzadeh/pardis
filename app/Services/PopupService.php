<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\PopupDto;
use App\Enums\PopupTypeEnum;
use App\Models\Popup;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PopupService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$popups = Popup::query()
			->regexpSearch($dto->term, ['title'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		return $this->datatableService->datatable(
			query: $popups,
			name: 'popups'
		)
			->addColumn('type', function (Popup $popup) {
				return __('admin/popup.words.types.' . $popup->type->value);
			})
			->addColumn('status_text', function (Popup $popup) {
				return $popup->status_text;
			})
			->toJson();
	}

	public function store(PopupDto $dto): ?Popup
	{
		try {
			DB::beginTransaction();

			$popup = Popup::create($dto->toArray());

			if (!is_null($dto->featureImage)) {
				$popup->upload($dto->featureImage, 'featureImage');
			}

			DB::commit();

			return $popup;
		} catch (\Exception $e) {
			DB::rollBack();
			return null;
		}
	}

	public function update(Popup $popup, PopupDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$popup->update($dto->toArray());

			$featureImage = $popup->getMediumByName('featureImage');
			if ($popup->type == PopupTypeEnum::Image) {
				if (!is_null($dto->featureImage)) {
					if (!is_null($featureImage)) {
						$popup->removeMedia($featureImage->id);
					}
					$popup->upload($dto->featureImage, 'featureImage');
				}
			} else {
				if (!is_null($featureImage)) {
					$popup->removeMedia($featureImage->id);
				}
			}

			DB::commit();

			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			return false;
		}
	}

	public function changeStatus(Popup $popup, PopupDto $dto): bool
	{
		return $popup->update($dto->toArrayStatus());
	}

	public function find(): ?Popup
	{
		return Popup::with('media')
			->orderBy('id', 'desc')
			->first();
	}
}