<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Meta extends Model
{
	protected $table = 'metas';
	protected $guarded = ['id'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function setMetaValueAttribute($value): void
	{
		$this->attributes['meta_value'] = General::toJson($value);
	}

	public function getMetaValueAttribute($value): mixed
	{
		return General::fromJson($value, true);
	}

	public function getMetaValueJsonAttribute(): mixed
	{
		return General::toJson($this->meta_value);
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
