<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceEditRequest extends FormRequest
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
			'title' => 'required',
			'description' => 'required',
			'full_description' => 'bail',
			'featureImage' => 'bail',
			'iconImage' => 'bail',
			'seo.title' => 'required',
			'seo.description' => 'required',
			'seo.keywords' => 'required',
			'seo.link' => 'required',
			'images' => 'bail',
			'faqs' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
			'title.required' => __('admin/service.errors.title.required'),
			'description.required' => __('admin/service.errors.description.required'),
			'full_description.required' => __('admin/service.errors.full_description.required'),
			'seo.title.required' => __('admin/seo.errors.title.required'),
			'seo.description.required' => __('admin/seo.errors.description.required'),
			'seo.keywords.required' => __('admin/seo.errors.keywords.required'),
			'seo.keywords.array' => __('admin/seo.errors.keywords.array'),
			'seo.link.required' => __('admin/seo.errors.link.required'),
		];
	}
}
