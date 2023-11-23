<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Contact extends Model
{
	use HasFactory;

	protected $guarded = ['id'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function getLinkAttribute(): string
	{
		switch ($this->contact_type) {
			case 'tell':
				return "tel:$this->contact_value";

			case 'email':
				return "mailto:$this->contact_value";

			case 'url':
				return $this->contact_value;

			default:
				return 'javascript:void(0);';
		}
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
