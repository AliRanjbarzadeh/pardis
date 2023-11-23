<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
			'username' => 'required',
			'password' => 'required',
			'remember' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
			'username.required' => __('admin/auth.validations.username.required'),
			'password.required' => __('admin/auth.validations.password.required'),
		];
	}
}
