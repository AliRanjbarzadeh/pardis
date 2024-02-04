<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class PermissionCategory extends Model
{
	use SoftDeletes;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function getTypeDotAttribute(): string
	{
		return $this->type . '.';
	}

	/*=============Relations==============*/
	public function permissions(): HasMany
	{
		return $this->hasMany(Permission::class);
	}

	public function children(): HasMany
	{
		return $this->hasMany(PermissionCategory::class);
	}

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
