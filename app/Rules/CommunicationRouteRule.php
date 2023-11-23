<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CommunicationRouteRule implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!is_array($value)) {
			$fail(__('admin/communication.errors.routes.required'));
		}

		if (empty($value)) {
			$fail(__('admin/communication.errors.routes.required'));
		}

		if (empty($value[0]['lines'])) {
			$fail(__('admin/communication.errors.routes.required'));
		}
	}
}
