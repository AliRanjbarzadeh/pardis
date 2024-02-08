<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
			'role_id' => 'required',
			'name' => 'required',
			'username' => is_null($this->admin) ? 'required|unique:users,username' : 'bail',
			'password' => is_null($this->admin) ? 'required|min:8|max:20' : 'bail',
			're_password' => 'same:password',
		];
	}

	public function messages(): array
	{
		return [
			'role_id.required' => __('admin/admin.errors.role_id.required'),
			'name.required' => __('admin/admin.errors.name.required'),
			'username.required' => __('admin/admin.errors.username.required'),
			'username.unique' => __('admin/admin.errors.username.unique'),
			'password.required' => __('admin/admin.errors.password.required'),
			'password.min' => __('admin/admin.errors.password.min'),
			'password.max' => __('admin/admin.errors.password.max'),
			're_password.same' => __('admin/admin.errors.re_password.same'),
		];
	}
}
