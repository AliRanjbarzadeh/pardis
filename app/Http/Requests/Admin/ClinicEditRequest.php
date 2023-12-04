<?php

namespace App\Http\Requests\Admin;

use App\Models\Clinic;
use App\Rules\SeoLinkRule;
use Illuminate\Foundation\Http\FormRequest;

class ClinicEditRequest extends FormRequest
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
			'featureImage' => 'bail',
			'seo.title' => 'required',
			'seo.description' => 'required',
			'seo.keywords' => 'bail',
			'seo.link' => ['required', new SeoLinkRule(Clinic::class, $this->clinic->id)],
			'insurances' => 'bail',
			'images' => 'bail',
			'work_hours' => 'bail',
			'contact' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
			'title.required' => __('admin/clinic.errors.title.required'),
			'description.required' => __('admin/clinic.errors.description.required'),
			'featureImage.required' => __('admin/global.errors.feature_image.required'),
			'seo.title.required' => __('admin/seo.errors.title.required'),
			'seo.description.required' => __('admin/seo.errors.description.required'),
			'seo.keywords.required' => __('admin/seo.errors.keywords.required'),
			'seo.keywords.array' => __('admin/seo.errors.keywords.array'),
			'seo.link.required' => __('admin/seo.errors.link.required'),
		];
	}
}
