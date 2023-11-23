<?php

namespace App\Models;

use App\Interfaces\MediaInterface;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Insurance extends Model implements MediaInterface
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

	/*=============Relations==============*/
	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class)->withTimestamps();
	}

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
	public function getSizes(): array
	{
		return [
			'thumbnail' => [
				'width' => 80,
				'height' => 80,
				'crop' => false,
			],
			'medium' => [
				'width' => 200,
				'height' => 200,
				'crop' => false,
			],
			'large' => [
				'width' => 300,
				'height' => 300,
				'crop' => false,
			],
		];
	}
}
