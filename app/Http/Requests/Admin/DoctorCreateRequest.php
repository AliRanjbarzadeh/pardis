<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorCreateRequest extends FormRequest
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
			'clinics' => 'required',
			'speciality_id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'medical_number' => 'required',
			'description' => 'required',
			'full_description' => 'required',
			'reservation_link' => 'required|url',
			'featureImage' => 'required',
			'seo.title' => 'required',
			'seo.description' => 'required',
			'seo.keywords' => 'required',
			'seo.link' => 'required',
			'insurances' => 'bail',
			'images' => 'bail',
			'work_hours' => 'bail',
			'social_networks' => 'bail',
			'resumes' => 'bail',
		];
	}

	public function messages(): array
	{
		return [
			'clinics.required' => __('admin/doctor.errors.clinics.required'),
			'speciality_id.required' => __('admin/doctor.errors.speciality_id.required'),
			'first_name.required' => __('admin/doctor.errors.first_name.required'),
			'last_name.required' => __('admin/doctor.errors.last_name.required'),
			'medical_number.required' => __('admin/doctor.errors.medical_number.required'),
			'description.required' => __('admin/doctor.errors.description.required'),
			'full_description.required' => __('admin/doctor.errors.full_description.required'),
			'reservation_link.required' => __('admin/doctor.errors.reservation_link.required'),
			'reservation_link.url' => __('admin/doctor.errors.reservation_link.url'),
			'featureImage.required' => __('admin/global.errors.feature_image.required'),
			'seo.title.required' => __('admin/seo.errors.title.required'),
			'seo.description.required' => __('admin/seo.errors.description.required'),
			'seo.keywords.required' => __('admin/seo.errors.keywords.required'),
			'seo.keywords.array' => __('admin/seo.errors.keywords.array'),
			'seo.link.required' => __('admin/seo.errors.link.required'),
		];
	}
}
