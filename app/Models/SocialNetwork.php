<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SocialNetwork extends Model
{
	use SoftDeletes;

	protected $guarded = ['id'];
	protected $with = ['socialNetworkType'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getAddressUrlAttribute(): string
	{
		return Str::replace(':mobile', $this->address, $this->socialNetworkType->link_pattern);
	}

	/*=============Relations==============*/
	public function socialNetworkType(): BelongsTo
	{
		return $this->belongsTo(SocialNetworkType::class);
	}

	/*=============Additional functions==============*/
}
