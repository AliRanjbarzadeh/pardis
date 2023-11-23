<?php

namespace App\Models;

use App\Interfaces\MediaInterface;
use App\Models\Scopes\UserTypeScope;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MediaInterface
{
	use HasFactory, HasMedia;

	protected $table = 'users';
	protected $guard = 'admin';
	public $type = 'admin';

	protected $guarded = ['id'];
	protected $hidden = ['password'];

	protected static function booted(): void
	{
		self::addGlobalScope(new UserTypeScope());
	}

	/*=============Scopes==============*/

	/*=============Accessors==============*/

	/*=============Relations==============*/

	/*=============Additional functions==============*/
}
