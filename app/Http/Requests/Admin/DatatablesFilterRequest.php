<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DatatablesFilterRequest extends FormRequest
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
			'title' => 'bail',
			'from_created_at' => 'bail',
			'to_created_at' => 'bail',
			'status' => 'bail',
			'full_name' => 'bail',
			'type' => 'bail',
			'category_id' => 'bail',
			'name' => 'bail',
			'email' => 'bail',
		];
	}
}
