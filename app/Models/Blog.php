<?php

namespace App\Models;

use App\Interfaces\CommentsInterface;
use App\Interfaces\MediaInterface;
use App\Interfaces\MetaInterface;
use App\Interfaces\RateInterface;
use App\Interfaces\SeoInterface;
use App\Traits\HasComment;
use App\Traits\HasMedia;
use App\Traits\HasMeta;
use App\Traits\HasRate;
use App\Traits\HasSearch;
use App\Traits\HasSeo;
use App\Traits\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Blog extends Model implements MediaInterface, CommentsInterface, SeoInterface, MetaInterface, RateInterface
{
	use HasFactory, SoftDeletes, HasMedia, HasComment, HasSeo, HasMeta, HasRate, HasSearch, HasTag;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];

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

	public function getAmpifyDescriptionAttribute(): string
	{
		$html = str_ireplace(
			['<img', '<video', '/video>', '<audio', '/audio>', '<iframe', '/iframe>', 'autostart="false"', 'autostart="true"', ' onclick="this.paused?this.play():this.pause()"'],
			['<amp-img  layout="responsive" ', '<amp-video', '/amp-video>', '<amp-audio', '/amp-audio>', '<amp-iframe layout="responsive"  sandbox="allow-scripts allow-same-origin allow-popups"  allowfullscreen  frameborder="0"', '/amp-iframe>', '', '', ''],
			$this->description
		);
		# Add closing tags to amp-img custom element
		//$html = preg_replace('/<amp-img(.*?)>/', '<amp-img$1></amp-img>',$html);

		# Whitelist of HTML tags allowed by AMP
		$html = strip_tags($html, '<iframe><amp-iframe><h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');

		$html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
		//$html = str_replace('</amp-img></amp-img>', '</amp-img>',$html);

		return $html;
	}

	public function getRateAverageAttribute(): int
	{
		return intval($this->rates->average('rate_value'));
	}

	public function getAmpUrlAttribute(): string
	{
		return route('amp.index', $this->seo->link);
	}

	/*=============Relations==============*/
	public function doctors(): BelongsToMany
	{
		return $this->belongsToMany(Doctor::class);
	}

	public function clinics(): BelongsToMany
	{
		return $this->belongsToMany(Clinic::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class)->withTimestamps();
	}

	/*=============Additional functions==============*/
	public function getCreatedAtFormatted(string $format): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format($format);
	}

	/*=============Vendor functions==============*/
	public function getSizes(): array
	{
		return [
			'thumbnail' => [
				'width' => 235,
				'height' => 116,
				'crop' => false,
			],
			'medium' => [
				'width' => 940,
				'height' => 464,
				'crop' => false,
			],
			'large' => [
				'width' => 1410,
				'height' => 696,
				'crop' => false,
			],
		];
	}
}
