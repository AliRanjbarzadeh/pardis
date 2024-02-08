<?php

namespace App\Traits;

use App\Enums\StatusEnum;
use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Morilog\Jalali\Jalalian;

trait HasSearch
{
	/**
	 * @param Builder $query
	 * @param string|null $fromDate
	 * @param string|null $toDate
	 *
	 * @return void
	 */
	public function scopeDateRangeSearch(Builder $query, ?string $fromDate, ?string $toDate): void
	{
		$fromDateStr = '';
		$toDateStr = '';
		if (!empty($fromDate)) {
			$fromDateStr = Jalalian::fromFormat('Y/m/d', $fromDate)->toCarbon()->format('Y-m-d');
		}

		if (!empty($toDate)) {
			$toDateStr = Jalalian::fromFormat('Y/m/d', $toDate)->toCarbon()->format('Y-m-d');
		}

		if (!empty($fromDateStr) && !empty($toDateStr)) {
			$query->whereDate('created_at', '>=', $fromDateStr)
				->whereDate('created_at', '<=', $toDateStr);
		}

		if (!empty($fromDateStr) && empty($toDateStr)) {
			$query->whereDate('created_at', '=', $fromDateStr);
		}

		if (empty($fromDateStr) && !empty($toDateStr)) {
			$query->whereDate('created_at', '<=', $toDateStr);
		}
	}

	/**
	 * @param $query
	 * @param string $term
	 * @param string|array $columns
	 *
	 * @return void
	 */
	public function scopeRegexpSearch(Builder $query, ?string $term, string|array $columns): void
	{
		if (is_null($term)) {
			return;
		}
		if (!is_array($columns)) {
			$columns = [$columns];
		}

		if (!empty(trim($term))) {
			$terms = explode(' ', $term);
			$query->where(function (Builder $query) use ($columns, $terms) {
				foreach ($terms as $termKey => $termValue) {
					foreach ($columns as $key => $column) {
						if ($termKey == 0 && $key == 0) {
							$query->where($column, 'regexp', $termValue);
						} else {
							$query->orWhere($column, 'regexp', $termValue);
						}
					}
				}
			});
		}
	}

	public function scopeStatusSearch(Builder $query, ?string $status): void
	{
		if (!is_null($status)) {
			$query->where('status', '=', StatusEnum::tryFrom($status));
		}
	}

	public function scopeTypeSearch(Builder $query, ?string $type): void
	{
		if (!is_null($type)) {
			$query->where('type', '=', TypeEnum::tryFrom($type));
		}
	}

	public function scopeCategorySearch(Builder $query, ?int $categoryId): void
	{
		if (!is_null($categoryId)) {
			$query->whereHas('categories', function ($query) use ($categoryId) {
				$query->where('categories.id', '=', $categoryId);
			});
		}
	}

	public function scopeCustomColumnSearch(Builder $query, string $column, string $operator, mixed $value): void
	{
		if (!is_null($value)) {
			$query->where($column, $operator, $value);
		}
	}
}