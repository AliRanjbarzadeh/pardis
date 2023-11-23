<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
			'content' => 'required',
			'email' => 'required',
			'subject' => 'required',
		];
	}

	public function messages(): array
	{
		return [
			'name' => __('front/contact_info.errors.name.required'),
			'content' => __('front/contact_info.errors.content.required'),
			'email' => __('front/contact_info.errors.email.required'),
			'subject' => __('front/contact_info.errors.subject.required'),
		];
	}
}
