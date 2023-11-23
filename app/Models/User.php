<?php

namespace App\Models;

use App\Interfaces\MediaInterface;
use App\Models\Scopes\UserTypeScope;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MediaInterface
{
	use HasApiTokens, HasFactory, Notifiable, HasMedia;

	protected $guard = 'web';
	public $type = 'user';

	protected $guarded = ['id'];
	protected $hidden = ['password'];

	protected static function booted()
	{
		self::addGlobalScope(new UserTypeScope());
	}

	/*=============Scopes==============*/

	/*=============Accessors==============*/

	/*=============Relations==============*/
	public function metas(): HasMany
	{
		return $this->hasMany(UserMeta::class);
	}

	/*=============Additional functions==============*/
}
