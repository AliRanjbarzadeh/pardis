<?php

namespace App\Services;

use App\DataTransferObjects\AdminDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Facades\Media;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$admins = Admin::query()
			->where('type', '=', 'admin')
			->where('is_super_admin', '=', false)
			->regexpSearch($dto->name, ['name'])
			->customColumnSearch('username', 'regexp', $dto->customColumns['username'])
			->with('role');

		return $this->datatableService
			->setPermissions([
				'edit' => 'admins.edit',
				'destroy' => 'admins.destroy',
			])
			->datatable(
				query: $admins,
				name: "admins",
			)
			->toJson();
	}

	public function store(AdminDto $dto): ?Admin
	{
		try {
			DB::beginTransaction();

			$admin = Admin::create($dto->toArray());

			if (!is_null($dto->profile)) {
				$admin->upload($dto->profile, 'profile');
			}

			DB::commit();
			return $admin;
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	public function update(Admin $admin, AdminDto $dto): bool
	{
		try {
			DB::beginTransaction();

			$admin->update($dto->toArray());

			$profile = $admin->getMediumByName('profile');
			if (!is_null($dto->profile)) {
				if (!is_null($profile)) {
					$admin->removeMedia($profile->id);
					Media::remove($profile->id);
				}
				$admin->upload($dto->profile, 'profile');
			}

			DB::commit();
			return true;
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error($e->getMessage(), $e->getTrace());
			return false;
		}
	}
}