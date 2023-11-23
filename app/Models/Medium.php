<?php

namespace App\Models;

use App\Facades\Media;
use App\Helpers\General;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Medium extends Model
{
	protected $guarded = ['id'];
	protected $appends = ['url'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function setSizesAttribute($value): void
	{
		$this->attributes['sizes'] = General::toJson($value);
	}

	public function getSizesAttribute($value): mixed
	{
		$decoded = General::fromJson($value, true);
		if ($decoded) {
			foreach ($decoded as $key => $path) {
				$decoded[$key] = Media::url($path);
			}
		}
		return $decoded;
	}

	public function getSizesPathsAttribute(): array
	{
		return General::fromJson($this->original['sizes'], true);
	}

	public function getUrlAttribute(): string
	{
		return Media::url($this->path);
	}

	public function getThumbnailAttribute(): string
	{
		if (!empty($this->sizes)) {
			return $this->sizes['thumbnail'];
		}

		return $this->url;
	}

	public function getMediumAttribute(): string
	{
		if (!empty($this->sizes)) {
			return $this->sizes['medium'];
		}

		return $this->url;
	}

	public function getLargeAttribute(): string
	{
		if (!empty($this->sizes)) {
			return $this->sizes['large'];
		}

		return $this->url;
	}

	/*=============Relations==============*/
	public function mediumable(): MorphTo
	{
		return $this->morphTo('mediumable', 'model_type', 'model_id');
	}

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
