<?php

namespace Database\Seeders;

use App\Models\SocialNetworkType;
use Illuminate\Database\Seeder;

class SocialNetworkTypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$types = [
			[
				'name' => 'اینستاگرام',
				'icon' => 'instagram',
				'link_pattern' => 'https://instagram.com/:mobile',
			],
			[
				'name' => 'واتس اپ',
				'icon' => 'whatsapp',
				'link_pattern' => 'https://wa.me/:mobile',
			],
			[
				'name' => 'تلگرام',
				'icon' => 'telegram',
				'link_pattern' => 'https://t.me/:mobile',
			],
			[
				'name' => 'توئیتر',
				'icon' => 'twitter',
				'link_pattern' => 'https://twitter/:mobile',
			],
			[
				'name' => 'لینکداین',
				'icon' => 'linkedin',
				'link_pattern' => 'https://linkedin.com/in/:mobile',
			],
			[
				'name' => 'یوتیوب',
				'icon' => 'youtube',
				'link_pattern' => ':mobile',
			],
			[
				'name' => 'ایمیل',
				'icon' => 'email',
				'link_pattern' => 'mailto::mobile',
			],
			[
				'name' => 'فیس بوک',
				'icon' => 'facebook',
				'link_pattern' => 'https://facebook.com/:mobile',
			],
		];

		foreach ($types as $type) {
			SocialNetworkType::create($type);
		}
	}
}
