<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Morilog\Jalali\Jalalian;

class Faq extends Model
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
	public function modelable(): MorphTo
	{
		return $this->morphTo();
	}

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
