<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
			'full_name' => 'required',
			'email' => 'required',
			'mobile' => 'bail',
			'body' => 'required|min:10',
			'model_type' => 'required',
		];
	}

	public function messages(): array
	{
		return [
			'full_name.required' => __('front/comment.errors.full_name.required'),
			'email.required' => __('front/comment.errors.email.required'),
			'body.required' => __('front/comment.errors.body.required'),
			'body.min' => __('front/comment.errors.body.min'),
			'model_type.required' => __('front/comment.errors.model_type.required'),
		];
	}
}
