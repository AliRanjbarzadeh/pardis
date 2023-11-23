<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;


class General
{
	public static function getLocaleFromDomain(string $domain): string
	{
		//get locale from domain root
		$locale = Str::replace(["http://", "https://", config('domain.base_domain')], "", $domain);

		//remove dots from locale
		$locale = trim($locale, ".");

		//set default locale
		if (empty($locale)) {
			$locale = config('app.locale');
		}

		return $locale;
	}

	public static function getDatabaseConnectionName(string $domain): string
	{
		$locale = self::getLocaleFromDomain($domain);

		$dbConnectionName = "mysql";
		if ($locale != config('app.locale')) {
			$dbConnectionName = "mysql_$locale";
		}

		return $dbConnectionName;
	}

	/**
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	public static function toJson(mixed $value): mixed
	{
		if (is_null($value)) {
			return $value;
		}

		if (is_numeric($value)) {
			return $value;
		}

		$encoded = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

		if ($encoded === false) {
			return $value;
		}

		return $encoded;
	}

	/**
	 * @param string|null $value
	 * @param bool $isArray
	 *
	 * @return mixed
	 */
	public static function fromJson(string|null $value, bool $isArray = false): mixed
	{
		$decoded = json_decode($value, $isArray);
		if (json_last_error() === JSON_ERROR_NONE) {
			return $decoded;
		}
		return $value;
	}

	public static function toSeoUrl(string $url): string
	{
		if (empty($url)) {
			return $url;
		}

		$words = explode("-", $url);
		$words = implode(" ", $words);

		$words = preg_replace('/[!-\/:-@[-`{-~]/', '', $words);
		$words = preg_replace('/÷+/', '', $words);
		$words = preg_replace('/٬+/', '', $words);
		$words = preg_replace('/٫+/', '', $words);
		$words = preg_replace('/٪+/', '', $words);
		$words = preg_replace('/×+/', '', $words);
		$words = preg_replace('/،+/', '', $words);
		$words = preg_replace('/ـ+/', '', $words);
		$words = preg_replace('/؟+/', '', $words);
		$words = preg_replace('/\s\s+/', '', $words);
		$words = trim($words);
		$words = explode(" ", $words);

		return implode("-", $words);
	}

	public static function urlToFile(string $url): UploadedFile
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);
		$info = pathinfo($url);
		$contents = file_get_contents($url, false, stream_context_create($arrContextOptions));
		$file = base_path('tmp/' . $info['basename']);
		file_put_contents($file, $contents);
		return new UploadedFile(path: $file, originalName: $info['basename'], test: true);
	}
}