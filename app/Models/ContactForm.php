<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class ContactForm extends Model
{
	use SoftDeletes, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];
	protected $casts = ['status' => StatusEnum::class];

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
