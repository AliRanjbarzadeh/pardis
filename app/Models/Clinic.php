<?php

namespace App\Models;

use App\Helpers\General;
use App\Interfaces\ContactInterface;
use App\Interfaces\InsuranceInterface;
use App\Interfaces\MediaInterface;
use App\Interfaces\SeoInterface;
use App\Traits\HasContact;
use App\Traits\HasInsurance;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Clinic extends Model implements MediaInterface, SeoInterface, InsuranceInterface, ContactInterface
{
	use HasFactory, SoftDeletes, HasMedia, HasSeo, HasInsurance, HasSearch, HasContact;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function setWorkHoursAttribute($value): void
	{
		$this->attributes['work_hours'] = General::toJson($value);
	}

	public function getWorkHoursAttribute($value): mixed
	{
		return General::fromJson($value, true);
	}

	public function getWorkHoursForInputAttribute(): array
	{
		$workHours = collect($this->work_hours);
		if ($workHours->isEmpty()) {
			return [];
		}

		return [
			'title' => $workHours->pluck('title')->all(),
			'first' => [
				'from' => $workHours->pluck('first.from')->all(),
				'to' => $workHours->pluck('first.to')->all(),
			],
			'second' => [
				'from' => $workHours->pluck('second.from')->all(),
				'to' => $workHours->pluck('second.to')->all(),
			],
		];
	}

	public function getShowLinkAttribute(): string
	{
		return route('clinics.show', $this->seo->link);
	}

	/*=============Relations==============*/
	public function blogs(): BelongsToMany
	{
		return $this->belongsToMany(Blog::class)->withTimestamps();
	}

	public function doctors(): BelongsToMany
	{
		return $this->belongsToMany(Doctor::class)->withTimestamps();
	}

	/*=============Additional functions==============*/
}
