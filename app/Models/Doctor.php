<?php

namespace App\Models;

use App\Helpers\General;
use App\Interfaces\CommentsInterface;
use App\Interfaces\ContactInterface;
use App\Interfaces\InsuranceInterface;
use App\Interfaces\MediaInterface;
use App\Interfaces\MetaInterface;
use App\Interfaces\SeoInterface;
use App\Interfaces\SocialNetworkInterface;
use App\Traits\HasComment;
use App\Traits\HasContact;
use App\Traits\HasInsurance;
use App\Traits\HasMedia;
use App\Traits\HasMeta;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use App\Traits\HasSocialNetwork;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class Doctor extends Model implements MediaInterface, SeoInterface, InsuranceInterface, CommentsInterface, SocialNetworkInterface, ContactInterface, MetaInterface
{
	use HasFactory, SoftDeletes, HasMedia, HasSeo, HasInsurance, HasComment, HasSocialNetwork, HasContact, HasMeta, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali', 'full_name'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function getFullNameAttribute(): string
	{
		return "$this->first_name $this->last_name";
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
			'from' => $workHours->pluck('from')->all(),
			'to' => $workHours->pluck('to')->all(),
		];
	}

	public function getResumesAttribute(): mixed
	{
		return $this->getMetaValue('resumes');
	}

	public function getResumesForInputAttribute(): array
	{
		if (empty($this->resumes)) {
			return [];
		}

		return [
			'title' => Arr::map($this->resumes, function ($item) {
				return $item['title'];
			}),
		];
	}

	public function getShowLinkAttribute(): string
	{
		return route('doctors.show', [$this, $this->seo->link]);
	}

	/*=============Relations==============*/
	public function blogs(): BelongsToMany
	{
		return $this->belongsToMany(Blog::class);
	}

	public function clinics(): BelongsToMany
	{
		return $this->belongsToMany(Clinic::class)->withTimestamps();
	}

	public function specialities(): BelongsToMany
	{
		return $this->belongsToMany(Speciality::class)->withTimestamps();
	}

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
