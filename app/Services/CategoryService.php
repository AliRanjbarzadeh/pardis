<?php

namespace App\Services;

use App\DataTransferObjects\CategoryDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Enums\TypeEnum;
use App\Models\Category;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$categories = Category::query()
			->whereNull('category_id')
			->typeSearch($dto->type)
			->regexpSearch($dto->term, ['name'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		$customActions = null;
		if ($dto->hasChildren) {
			$customActions = [
				[
					'title' => __('admin/category.words.children'),
					'url' => 'admin.categories.' . $dto->type . '.children.index',
					'icon' => 'bx bx-category text-primary',
					'isButton' => false,
				],
			];
		}

		return $this->datatableService->datatable(
			query: $categories,
			name: "categories.$dto->type",
			customActions: $customActions,
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

	/**
	 * @param TypeEnum $type
	 * @param bool $hasChildren
	 * @param array|null $relations
	 * @param array|null $counts
	 *
	 * @return Collection|array|Category[]
	 */
	public function all(TypeEnum $type, bool $hasChildren = false, ?array $relations = null, ?array $counts = null): Collection|array
	{
		$categories = Category::query()->where('type', '=', $type)
			->whereNull('category_id')
			->orderBy('priority');

		if ($hasChildren) {
			$categories->with([
				'categories' => function ($query) {
					$query->orderBy('priority');
				},
			])->whereHas('categories');
		}

		if (!is_null($relations)) {
			$categories->with($relations);
		}

		if (!is_null($counts)) {
			$categories->withCount($counts);
		}

		return $categories->get();
	}

	/**
	 * @return Collection|array|Category[]
	 */
	public function sidebarBlog(): Collection|array
	{
		return Category::whereType(TypeEnum::Blog)
			->whereNull('category_id')
			->whereHas('blogs')
			->with('seo')
			->withCount('blogs')
			->orderBy('priority')
			->get();
	}

	public function findByLink(TypeEnum $type, string $link): ?Category
	{
		return Category::whereType($type)
			->whereHas('seo', function ($query) use ($link) {
				$query->where('link', '=', $link);
			})
			->first();
	}
}