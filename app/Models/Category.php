<?php

namespace App\Models;

use App\Enums\TypeEnum;
use App\Interfaces\SeoInterface;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Category extends Model implements SeoInterface
{
	use HasFactory, SoftDeletes, HasSeo, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];
	protected $casts = [
		'type' => TypeEnum::class,
	];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	/*=============Relations==============*/
	public function categories(): HasMany
	{
		return $this->hasMany(Category::class);
	}

	public function blogs(): BelongsToMany
	{
		return $this->belongsToMany(Blog::class);
	}

	/*=============Additional functions==============*/
	public function getDetailLink(string $part): ?string
	{
		switch (TypeEnum::tryFrom($part)) {
			case TypeEnum::Blog:
				return route('blogs.category', $this->seo->link);

			default:
				return null;
		}
	}

	/*=============Vendor functions==============*/
}
