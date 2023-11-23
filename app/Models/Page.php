<?php

namespace App\Models;

use App\Enums\PageTypeEnum;
use App\Interfaces\ContactInterface;
use App\Interfaces\FaqInterface;
use App\Interfaces\MediaInterface;
use App\Interfaces\MetaInterface;
use App\Interfaces\SeoInterface;
use App\Interfaces\SocialNetworkInterface;
use App\Traits\HasContact;
use App\Traits\HasFaq;
use App\Traits\HasMedia;
use App\Traits\HasMeta;
use App\Traits\HasSeo;
use App\Traits\HasSocialNetwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Page extends Model implements MediaInterface, MetaInterface, SeoInterface, SocialNetworkInterface, ContactInterface, FaqInterface
{
	use SoftDeletes, HasMedia, HasMeta, HasSeo, HasSocialNetwork, HasContact, HasFaq;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];
	protected $casts = ['type' => PageTypeEnum::class];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
