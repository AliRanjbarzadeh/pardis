<?php

namespace App\Models;

use App\Interfaces\CommentsInterface;
use App\Interfaces\MediaInterface;
use App\Interfaces\MetaInterface;
use App\Interfaces\RateInterface;
use App\Interfaces\SeoInterface;
use App\Traits\HasComment;
use App\Traits\HasMedia;
use App\Traits\HasMeta;
use App\Traits\HasRate;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use App\Traits\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Blog extends Model implements MediaInterface, CommentsInterface, SeoInterface, MetaInterface, RateInterface
{
	use HasFactory, SoftDeletes, HasMedia, HasComment, HasSeo, HasMeta, HasRate, HasSearch, HasTag;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function getCreatedAtAgoAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->ago();
	}

	/*=============Relations==============*/
	public function doctors(): BelongsToMany
	{
		return $this->belongsToMany(Doctor::class);
	}

	public function clinics(): BelongsToMany
	{
		return $this->belongsToMany(Clinic::class);
	}

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
				'width' => 235,
				'height' => 116,
				'crop' => false,
			],
			'medium' => [
				'width' => 940,
				'height' => 464,
				'crop' => false,
			],
			'large' => [
				'width' => 1410,
				'height' => 696,
				'crop' => false,
			],
		];
	}
}
