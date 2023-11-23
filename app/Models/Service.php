<?php

namespace App\Models;

use App\Interfaces\CommentsInterface;
use App\Interfaces\FaqInterface;
use App\Interfaces\MediaInterface;
use App\Interfaces\SeoInterface;
use App\Traits\HasComment;
use App\Traits\HasFaq;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Service extends Model implements CommentsInterface, SeoInterface, MediaInterface, FaqInterface
{
	use HasFactory, SoftDeletes, HasComment, HasSeo, HasMedia, HasFaq, HasSearch;

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

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
