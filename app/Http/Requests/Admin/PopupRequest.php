<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PopupRequest extends FormRequest
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
		$validations = [
			'type' => 'required',
			'title' => 'required',
			'description' => 'required_if:type,text',
			'url' => 'required_if:type,image',
			'featureImage' => 'required_if:type,image|file',
		];

		if (!is_null($this->popup)) {
			if (!is_null($this->popup->getMediumByName('featureImage'))) {
				$validations['featureImage'] = 'bail';
			}
		}

		return $validations;
	}

	public function messages(): array
	{
		return [
			'type.required' => __('admin/popup.errors.type.required'),
			'title.required' => __('admin/popup.errors.title.required'),
			'description.required_if' => __('admin/popup.errors.description.required'),
			'url.required_if' => __('admin/popup.errors.url.required'),
			'url.url' => __('admin/popup.errors.url.url'),
			'featureImage.required_if' => __('admin/global.errors.feature_image.required'),
			'featureImage.file' => __('admin/global.errors.feature_image.file'),
		];
	}
}
