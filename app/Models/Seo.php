<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Seo extends Model
{
	use HasFactory;

	protected $guarded = ['id'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function setLinkAttribute($value): void
	{
		$this->attributes['link'] = General::toSeoUrl($value);
	}

	public function setKeywordsAttribute($value): void
	{
		if (is_null($value)) {
			$value = '';
		}

		if (is_string($value) && Str::contains($value, ',')) {
			$value = explode(',', $value);
		}

		if (!is_array($value)) {
			$value = [$value];
		}

		$this->attributes['keywords'] = implode(',', $value);
	}

	public function getKeywordsArrayAttribute(): array
	{
		if (empty($this->keywords)) {
			return [];
		}
		return explode(',', $this->keywords);
	}

	public function setCustomAttribute($value): void
	{
		if (!is_null($value)) {
			$value = General::toJson($value);
		}

		$this->attributes['custom'] = $value;
	}

	public function getCustomAttribute($value): mixed
	{
		if (!is_null($value)) {
			$value = General::fromJson($value, true);
		}

		return $value;
	}

	/*=============Relations==============*/
	public function modelable(): MorphTo
	{
		return $this->morphTo();
	}

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
