<?php

namespace App\Services;

use App\DataTransferObjects\BlogDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Exceptions\MediaException;
use App\Models\Blog;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function search(string $term, array $ids): JsonResponse
	{
		$blogs = Blog::regexpSearch($term, ['title', 'description'])
			->with([
				'media' => function ($query) {
					$query->where('medium_items.name', '=', 'featureImage');
				},
			]);

		if (!empty($ids)) {
			$blogs = $blogs->whereNotIn('id', $ids);
		}

		return response()->json($blogs->get());
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$blogs = Blog::query()
			->regexpSearch($dto->term, ['title'])
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->categorySearch($dto->categoryId)
			->with(['categories']);

		$customActions = [
			//comments
			[
				'title' => __('admin/comment.plural'),
				'url' => 'admin.blogs.comments.index',
				'icon' => 'bx bx-message-square-dots text-primary',
				'isButton' => false,
			],
		];

		return $this->datatableService->datatable(
			query: $blogs,
			name: 'blogs',
			customActions: $customActions
		)->toJson();
	}

	public function store(BlogDto $dto): ?Blog
	{
		try {
			DB::beginTransaction();

			$blog = Blog::create($dto->toArray());

			//category
			$blog->categories()->attach($dto->categoryId);

			//doctor
			if (!is_null($dto->doctorId)) {
				$blog->doctors()->attach($dto->doctorId);
			}

			//clinic
			if (!is_null($dto->clinicId)) {
				$blog->clinics()->attach($dto->clinicId);
			}

			//feature image
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				$blog->upload($dto->featureImage, 'featureImage');
			}

			//save seo items
			$blog->saveSeoInformation($dto->seo);

			//save tags
			if (!is_null($dto->tags)) {
				$blog->addTags($dto->tags);
			}

			DB::commit();

			return $blog;
		} catch (Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Blog $blog, BlogDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$blog->update($dto->toArray());

			//category
			$blog->categories()->sync([$dto->categoryId]);

			//doctor
			if (!is_null($dto->doctorId)) {
				$blog->doctors()->sync([$dto->doctorId]);
			}

			//clinic
			if (!is_null($dto->clinicId)) {
				$blog->clinics()->sync([$dto->clinicId]);
			}

			//feature image
			$featureImage = $blog->getMediumByName('featureImage');
			if (!is_null($dto->featureImage) && $dto->featureImage->isValid()) {
				if (!is_null($featureImage)) {
					$blog->removeMedia($featureImage->id);
				}
				$blog->upload($dto->featureImage, 'featureImage');
			}

			//save seo items
			$blog->updateSeoInformation($dto->seo);

			//save tags
			if (!is_null($dto->tags)) {
				$blog->updateTags($dto->tags);
			}

			DB::commit();

			return true;
		} catch (Exception|MediaException $e) {
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
	 * @return Collection|array|Blog[]
	 */
	public function all(int $limit = 0, array $orderBy = ['created_at', 'desc'], array $relations = []): Collection|array
	{
		$blogs = Blog::query();

		if (!empty($relations)) {
			$blogs->with($relations);
		}

		if ($limit > 0) {
			$blogs->limit($limit);
		}

		$blogs->orderBy($orderBy[0], $orderBy[1]);

		return $blogs->get();
	}

	public function paginated(int $perPage, int $categoryId = 0, ?string $term = null): LengthAwarePaginator
	{
		$blogs = Blog::with([
			'media',
			'categories',
			'seo',
		])->latest();

		if ($categoryId > 0) {
			$blogs->whereHas('categories', function ($query) use ($categoryId) {
				$query->where('categories.id', '=', $categoryId);
			});
		}

		$blogs->regexpSearch($term, ['title', 'description']);

		return $blogs->paginate($perPage)->withQueryString()->onEachSide(1);
	}

	public function findByIds(?array $ids, ?array $relations = null): Collection
	{
		if (is_null($ids) || empty($ids)) {
			return collect();
		}
		$blogs = Blog::query()->whereIn('id', $ids);

		if (!is_null($relations)) {
			$blogs->with($relations);
		}

		$blogs->latest();

		return $blogs->get();
	}

	public function findByLink(string $link): ?Blog
	{
		return Blog::whereHas('seo', function ($query) use ($link) {
			$query->where('link', '=', $link);
		})->with([
			'seo', 'media', 'metas', 'tags', 'categories.seo',
			'clinics' => function ($query) {
				$query->with(['seo', 'media']);
			},
			'doctors' => function ($query) {
				$query->with(['seo', 'media', 'specialities']);
			},
		])->withCount('comments')->first();
	}
}