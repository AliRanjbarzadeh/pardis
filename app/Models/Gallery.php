<?php

namespace App\Models;

use App\Interfaces\MediaInterface;
use App\Interfaces\SeoInterface;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Gallery extends Model implements MediaInterface, SeoInterface
{
	use HasFactory, SoftDeletes, HasMedia, HasSeo, HasSearch;

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
}
