<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Helpers\General;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Comment extends Model
{
	use HasFactory, SoftDeletes, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali', 'status_text'];
	protected $casts = [
		'status' => StatusEnum::class,
	];

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

	public function getStatusTextAttribute(): string
	{
		return __('admin/status.words.' . $this->status->value);
	}

	public function getProfileNameAttribute(): string
	{
		$name = [];
		$words = explode(' ', $this->full_name);

		if (!empty($words)) {
			$name[] = mb_substr($words[0], 0, 1);
//			$name[] = mb_substr(end($words), 0, 1);
		}

		return implode("", $name);
	}

	public function setUserAgentInfoAttribute($value): void
	{
		$this->attributes['user_agent_info'] = General::toJson($value);
	}

	public function getUserAgentInfoAttribute($value): mixed
	{
		return General::fromJson($value, true);
	}

	/*=============Relations==============*/
	public function commentable(): MorphTo
	{
		return $this->morphTo('commentable', 'model_type', 'model_id');
	}

	/*=============Additional functions==============*/
	public function getCreatedAtFormatted(string $format): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format($format);
	}
}
