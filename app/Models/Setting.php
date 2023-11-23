<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $guarded = ['id'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function setSettingValueAttribute($value): void
	{
		$this->attributes['setting_value'] = General::toJson($value);
	}

	public function getSettingValueAttribute($value): mixed
	{
		return General::fromJson($value, true);
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/
}
