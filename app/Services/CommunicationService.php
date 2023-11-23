<?php

namespace App\Services;

use App\DataTransferObjects\CommunicationDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Models\Communication;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class CommunicationService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$communications = Communication::query()
			->regexpSearch($dto->term, ['title']);

		return $this->datatableService->datatable(
			query: $communications,
			name: 'communications',
			hasPriority: true
		)->toJson();
	}

	public function store(CommunicationDto $dto): ?Communication
	{
		return Communication::create($dto->toArray());
	}

	public function update(Communication $communication, CommunicationDto $dto): bool
	{
		return $communication->update($dto->toArray());
	}

	/**
	 * @return Collection|array|Communication[]
	 */
	public function all(): Collection|array
	{
		return Communication::orderBy('priority')->get();
	}
}