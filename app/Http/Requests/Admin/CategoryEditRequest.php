<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Rules\SeoLinkRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
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
			'category_id' => 'bail|exists:categories,id',
			'name' => 'required',
			'type' => 'required',
			'priority' => 'required',
			'seo.title' => 'required_without:name',
			'seo.description' => 'bail',
			'seo.keywords' => 'bail',
			'seo.link' => ['required_without:name', new SeoLinkRule(Category::class, $this->category->id)],
		];
	}

	public function messages(): array
	{
		return [
			'category_id.exists' => __('admin/category.errors.parent.exists'),
			'name.required' => __('admin/category.errors.name.required'),
			'priority.required' => __('admin/global.errors.priority.required'),
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
