<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
			'description' => 'required',
			'url' => 'required',
		];
	}

	public function messages(): array
	{
		return [
			'description.required' => __('admin/testimonial.errors.description.required'),
			'url.required' => __('admin/testimonial.errors.url.required'),
		];
	}
}
