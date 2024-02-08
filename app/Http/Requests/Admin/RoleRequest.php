<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
			'permissions' => 'required|array',
		];
	}

	public function messages(): array
	{
		return [
			'name.required' => __('admin/role.errors.name.required'),
			'permissions.required' => __('admin/role.errors.permissions.required'),
			'permissions.array' => __('admin/role.errors.permissions.array'),
		];
	}
}
