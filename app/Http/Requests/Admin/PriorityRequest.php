<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PriorityRequest extends FormRequest
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
			'model' => 'required',
			'priorities' => 'required',
		];
	}

	public function messages()
	{
		return [
			'model.required' => __('admin/global.errors.not_found'),
			'priorities.required' => __('admin/global.errors.not_found'),
		];
	}
}
