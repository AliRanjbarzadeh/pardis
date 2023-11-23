<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\TestimonialDto;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class TestimonialService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$testimonials = Testimonial::query()
			->regexpSearch($dto->term, ['description'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		return $this->datatableService->datatable(
			query: $testimonials,
			name: 'testimonials',
			hasPriority: true
		)->toJson();
	}

	public function store(TestimonialDto $dto): ?Testimonial
	{
		return Testimonial::create($dto->toArray());
	}

	public function update(Testimonial $testimonial, TestimonialDto $dto): bool
	{
		return $testimonial->update($dto->toArray());
	}

	/**
	 * @return Collection|array|Testimonial[]
	 */
	public function all(): Collection|array
	{
		return Testimonial::orderBy('priority')->get();
	}
}