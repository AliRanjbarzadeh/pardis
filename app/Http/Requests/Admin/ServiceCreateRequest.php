<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use App\Rules\SeoLinkRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
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
			'featureImage' => 'required',
			'iconImage' => 'required',
			'seo.title' => 'required_without:title',
			'seo.description' => 'bail',
			'seo.keywords' => 'bail',
			'seo.link' => ['required_without:title', new SeoLinkRule(Service::class)],
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
			'featureImage.required' => __('admin/global.errors.feature_image.required'),
			'iconImage.required' => __('admin/global.errors.icon_image.required'),
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
