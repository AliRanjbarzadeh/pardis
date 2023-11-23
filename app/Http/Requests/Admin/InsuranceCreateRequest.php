<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceCreateRequest extends FormRequest
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
			'name' => 'required',
			'description' => 'required',
			'featureImage' => 'required',
			'categories' => 'bail|array',
		];
	}

	public function messages(): array
	{
		return [
			'name.required' => __('admin/insurance.errors.name.required'),
			'description.required' => __('admin/insurance.errors.description.required'),
			'featureImage.required' => __('admin/global.errors.feature_image.required'),
		];
	}
}
