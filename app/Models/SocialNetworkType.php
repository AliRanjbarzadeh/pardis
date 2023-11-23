<?php

namespace App\Models;

use App\Interfaces\MediaInterface;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialNetworkType extends Model implements MediaInterface
{
	use SoftDeletes, HasMedia;

	protected $guarded = ['id'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/

	/*=============Relations==============*/

	/*=============Additional functions==============*/
	public function getSizes(): array
	{
		return [
			'thumbnail' => [
				'width' => 50,
				'height' => 50,
				'crop' => false,
			],
			'medium' => [
				'width' => 100,
				'height' => 100,
				'crop' => false,
			],
			'large' => [
				'width' => 200,
				'height' => 200,
				'crop' => false,
			],
		];
	}
}
