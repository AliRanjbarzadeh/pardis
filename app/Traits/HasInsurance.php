<?php

namespace App\Traits;

use App\DataTransferObjects\InsuranceItemDto;
use App\Exceptions\InsuranceItemException;
use App\Models\Insurance;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait HasInsurance
{
	/**
	 * @return MorphToMany
	 */
	public function insurances(): MorphToMany
	{
		return $this->morphToMany(
			Insurance::class,
			'model',
			'insurance_items'
		)->withTimestamps();
	}

	/**
	 * @param Collection|InsuranceItemDto $insuranceItems
	 *
	 * @return void
	 * @throws InsuranceItemException
	 */
	public function addInsurances(Collection|InsuranceItemDto $insuranceItems): void
	{
		$this->insurances()->attach($this->parseInsuranceItems($insuranceItems));
	}

	/**
	 * @param Collection|InsuranceItemDto $insuranceItems
	 *
	 * @return void
	 * @throws InsuranceItemException
	 */
	public function updateInsurances(Collection|InsuranceItemDto $insuranceItems): void
	{
		$this->insurances()->sync($this->parseInsuranceItems($insuranceItems));
	}

	/**
	 * @param int|array $ids
	 *
	 * @return void
	 */
	public function removeInsurances(int|array $ids): void
	{
		$this->insurances()->detach($ids);
	}

	/*======================Inner Methods========================*/
	private function parseInsuranceItems(Collection|InsuranceItemDto $insuranceItems): int|Collection
	{
		if ($insuranceItems instanceof InsuranceItemDto) {
			return $insuranceItems->insuranceId;
		}

		if ($insuranceItems->isEmpty()) {
			throw new InsuranceItemException("No id(s) provided");
		}

		return $insuranceItems->map(function (InsuranceItemDto $item) {
			return $item->toArray();
		});
	}
}