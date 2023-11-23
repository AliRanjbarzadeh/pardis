<?php

namespace App\Rules;

use App\Services\SeoService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SeoLinkRule implements ValidationRule
{
	protected SeoService $service;
	protected string $modelType;
	protected ?int $modelId;

	public function __construct(string $modelType, ?int $modelId = null)
	{
		$this->service = app(SeoService::class);
		$this->modelId = $modelId;
		$this->modelType = $modelType;
	}

	/**
	 * Run the validation rule.
	 *
	 * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$seo = $this->service->validation($value, $this->modelType, $this->modelId);
		if (!is_null($seo)) {
			$fail(__('admin/seo.errors.link.unique'));
		}
	}
}
