<?php

namespace App\Http\Requests\Admin;

use App\Models\Blog;
use App\Rules\SeoLinkRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogEditRequest extends FormRequest
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
			'category_id' => 'required',
			'clinic_id' => 'required',
			'doctor_id' => 'required',
			'title' => 'required',
			'description' => 'required',
			'featureImage' => 'bail',
			'seo.title' => 'required_without:title',
			'seo.description' => 'bail',
			'seo.keywords' => 'bail',
			'seo.link' => ['required_without:title', new SeoLinkRule(Blog::class, $this->blog->id)],
			'tags' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
			'category_id.required' => __('admin/blog.errors.category.required'),
			'clinic_id.required' => __('admin/blog.errors.clinic.required'),
			'doctor_id.required' => __('admin/blog.errors.doctor.required'),
			'title.required' => __('admin/blog.errors.title.required'),
			'description.required' => __('admin/blog.errors.description.required'),
			'featureImage.required' => __('admin/global.errors.feature_image.required'),
			'seo.title.required' => __('admin/seo.errors.title.required'),
			'seo.description.required' => __('admin/seo.errors.description.required'),
			'seo.keywords.required' => __('admin/seo.errors.keywords.required'),
			'seo.keywords.array' => __('admin/seo.errors.keywords.array'),
			'seo.link.required' => __('admin/seo.errors.link.required'),
		];
	}
}
