<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Permission extends Model
{
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

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
