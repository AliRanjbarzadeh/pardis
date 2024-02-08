<?php

namespace App\Models;

use App\Interfaces\MediaInterface;
use App\Models\Scopes\UserTypeScope;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Morilog\Jalali\Jalalian;

class Admin extends Authenticatable implements MediaInterface
{
	use HasFactory, HasMedia, HasSearch;

	protected $table = 'users';
	protected $guard = 'admin';
	public $type = 'admin';

	protected $guarded = ['id'];
	protected $hidden = ['password'];
	protected $appends = ['created_at_jalali'];
	protected $with = ['role', 'permissions'];

	protected static function booted(): void
	{
		self::addGlobalScope(new UserTypeScope());
	}

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	/*=============Relations==============*/
	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class)->with('permissions');
	}

	public function permissions(): BelongsToMany
	{
		return $this->belongsToMany(Permission::class)->using(AdminPermission::class);
	}

	/*=============Additional functions==============*/
	public function hasPermission(int|string $permissionId): bool
	{
		if (is_string($permissionId)) {
			return $this->permissions->where('type', '=', $permissionId)->isNotEmpty()
			|| $this->role?->hasPermission($permissionId) ?? false;
		}
		return $this->permissions->where('id', '=', $permissionId)->isNotEmpty()
		|| $this->role?->hasPermission($permissionId) ?? false;
	}
}
