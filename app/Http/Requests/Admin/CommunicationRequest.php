<?php

namespace App\Http\Requests\Admin;

use App\Rules\CommunicationRouteRule;
use Illuminate\Foundation\Http\FormRequest;

class CommunicationRequest extends FormRequest
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
			'routes' => ['required', new CommunicationRouteRule()],
		];
	}

	public function messages(): array
	{
		return [
			'title.required' => __('admin/communication.errors.title.required'),
			'routes.required' => __('admin/communication.errors.routes.required'),
		];
	}
}
