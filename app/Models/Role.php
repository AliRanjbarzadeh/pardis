<?php

namespace App\Models;

use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Role extends Model
{
	use SoftDeletes, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	/*=============Relations==============*/
	public function permissions(): BelongsToMany
	{
		return $this->belongsToMany(Permission::class)->using(PermissionRole::class);
	}

	/*=============Additional functions==============*/
	public function hasPermission(int|string $permissionId): bool
	{
		if (is_string($permissionId)) {
			return $this->permissions->where('type', '=', $permissionId)->isNotEmpty();
		}
		return $this->permissions->where('id', '=', $permissionId)->isNotEmpty();
	}

	/*=============Vendor functions==============*/
}
