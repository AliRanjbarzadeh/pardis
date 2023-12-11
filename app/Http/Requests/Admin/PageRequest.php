<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
			'description' => 'bail',
			'full_description' => 'bail',
			'seo.title' => 'required_without:title',
			'seo.description' => 'bail',
			'seo.keywords' => 'bail',
			'seo.link' => 'required_without:title',
			'metas' => 'bail',
			'faqs' => 'bail',
			'featureImage' => 'bail',
			'social_networks' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
			'title.required' => __('admin/page.errors.title.required'),
			'description.required' => __('admin/page.errors.description.required'),
			'full_description.required' => __('admin/page.errors.full_description.required'),
			'seo.title.required' => __('admin/seo.errors.title.required'),
			'seo.title.required_without' => __('admin/seo.errors.title.required'),
			'seo.description.required' => __('admin/seo.errors.description.required'),
			'seo.keywords.required' => __('admin/seo.errors.keywords.required'),
			'seo.keywords.array' => __('admin/seo.errors.keywords.array'),
			'seo.link.required' => __('admin/seo.errors.link.required'),
			'seo.link.required_without' => __('admin/seo.errors.link.required'),
		];
	}
}
