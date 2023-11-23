<?php

namespace App\Models;

use App\Enums\SliderPageEnum;
use App\Interfaces\MediaInterface;
use App\Interfaces\MetaInterface;
use App\Traits\HasMedia;
use App\Traits\HasMeta;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Slider extends Model implements MediaInterface, MetaInterface
{
	use SoftDeletes, HasMedia, HasMeta, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];
	protected $casts = ['page' => SliderPageEnum::class];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function getSwiperSlideAttribute(): array
	{
		return [
			'title' => $this->title,
			'description' => $this->description,
			'url' => $this->link,
		];
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
	public function getSizes(): array
	{
		return [
			'thumbnail' => [
				'width' => 496,
				'height' => 275,
				'crop' => false,
			],
			'medium' => [
				'width' => 992,
				'height' => 550,
				'crop' => false,
			],
			'large' => [
				'width' => 1984,
				'height' => 1100,
				'crop' => false,
			],
		];
	}
}
