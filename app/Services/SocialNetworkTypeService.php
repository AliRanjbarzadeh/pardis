<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\SocialNetworkTypeDto;
use App\Models\SocialNetworkType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class SocialNetworkTypeService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$socialnetworktypes = SocialNetworkType::query()
			->regexpSearch($dto->term, ['title', 'description'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->orderBy('priority');

		return $this->datatableService->datatable($socialnetworktypes, 'socialNetworkTypes')
			->toJson();
	}

	public function store(SocialNetworkTypeDto $dto): ?SocialNetworkType
	{
		return SocialNetworkType::create($dto->toArray());
	}

	public function update(SocialNetworkType $socialnetworktype, SocialNetworkTypeDto $dto): bool
	{
		return $socialnetworktype->update($dto->toArray());
	}

	/**
	 * @return Collection|array|SocialNetworkType[]
	 */
	public function all(): Collection|array
	{
		return SocialNetworkType::all();
	}
}