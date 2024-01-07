<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Rate extends Model
{
	protected $guarded = ['id'];

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
