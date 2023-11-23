<?php

namespace App\Interfaces;

use App\DataTransferObjects\InsuranceItemDto;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

interface InsuranceInterface
{

	public function insurances(): MorphToMany;

	public function addInsurances(Collection|InsuranceItemDto $insuranceItems): void;

	public function updateInsurances(Collection|InsuranceItemDto $insuranceItems): void;

	public function removeInsurances(int|array $ids): void;
}