<?php

namespace App\Services;

use App\DataTransferObjects\CategoryDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryChildService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$categories = Category::query()
			->where('category_id', '=', $dto->parent)
			->typeSearch($dto->type)
			->regexpSearch($dto->term, ['name'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		return $this->datatableService->datatable(
			query: $categories,
			name: "categories.$dto->type.children",
			urlParams: [$dto->parent],
			hasPriority: true
		)->toJson();
	}

	public function store(CategoryDto $dto): ?Category
	{
		try {
			DB::beginTransaction();
			$category = Category::create($dto->toArray());
			$category->saveSeoInformation($dto->seo);

			DB::commit();
			return $category;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Category $category, CategoryDto $dto): bool
	{
		try {
			DB::beginTransaction();
			$category->update($dto->toArray());
			$category->updateSeoInformation($dto->seo);

			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return false;
		}
	}
}