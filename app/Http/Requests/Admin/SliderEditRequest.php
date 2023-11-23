<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderEditRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'priority' => 'bail',
			'title' => 'bail',
			'description' => 'bail',
			'link' => 'bail',
			'featureImage' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
		];
	}
}
