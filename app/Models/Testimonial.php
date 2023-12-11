<?php

namespace App\Models;

use App\Facades\Aparat;
use App\Interfaces\MediaInterface;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Testimonial extends Model implements MediaInterface
{
	use HasFactory, SoftDeletes, HasMedia, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function setUrlAttribute($value): void
	{
		$this->attributes['url'] = Aparat::getEmbededLink($value);
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
