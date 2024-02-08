<?php

namespace App\Services;

use App\DataTransferObjects\DatatablesFilterDto;
use App\DataTransferObjects\RoleDto;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$roles = Role::query()
			->dateRangeSearch($dto->fromDate, $dto->toDate)
			->regexpSearch($dto->term, ['name']);

		return $this->datatableService->datatable(
			query: $roles,
			name: "roles",
		)->toJson();
	}

	public function store(RoleDto $dto): ?Role
	{
		try {
			DB::beginTransaction();

			$role = Role::create($dto->toArray());

			//add role permissions
			if (!empty($dto->permissions)) {
				$role->permissions()->attach($dto->permissions);
			}

			DB::commit();
			return $role;
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Role $role, RoleDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$role->update($dto->toArray());

			//update role permissions
			$role->permissions()->sync($dto->permissions);

			DB::commit();
			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return false;
		}
	}

	/**
	 * @return Collection|array|Role[]
	 */
	public function all(): Collection|array
	{
		return Role::with('permissions')
			->get();
	}
}