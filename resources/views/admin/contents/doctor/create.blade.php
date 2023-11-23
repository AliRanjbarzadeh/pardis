@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.doctors.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="row mb-3">
									<div class="col-md-4 mb-sm-3">
										<label for="first_name" class="form-label">@lang('admin/doctor.fields.first_name')</label>
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="@lang('admin/doctor.placeholders.first_name')" value="{{ old('first_name') }}" data-seo-title data-seo-link/>
									</div>

									<div class="col-md-4">
										<label for="last_name" class="form-label">@lang('admin/doctor.fields.last_name')</label>
										<input type="text" class="form-control" id="last_name" name="last_name" placeholder="@lang('admin/doctor.placeholders.last_name')" value="{{ old('last_name') }}" data-seo-title-child data-seo-link-child/>
									</div>

									<div class="col-md-4">
										<label for="medical_number" class="form-label">@lang('admin/doctor.fields.medical_number')</label>
										<input type="text" class="form-control" id="medical_number" name="medical_number" placeholder="@lang('admin/doctor.placeholders.medical_number')" value="{{ old('medical_number') }}"/>
									</div>
								</div>

								<div class="mb-3">
									<label for="reservation_link" class="form-label">@lang('admin/doctor.fields.reservation_link')</label>
									<input type="text" class="form-control" id="reservation_link" name="reservation_link" placeholder="@lang('admin/doctor.placeholders.reservation_link')" value="{{ old('reservation_link') }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/doctor.fields.description')</label>
									<textarea class="form-control" id="description" name="description" placeholder="@lang('admin/doctor.placeholders.description')" rows="4">{{ old('description') }}</textarea>
								</div>

								<div class="mb-3">
									<label for="full_description" class="form-label">@lang('admin/doctor.fields.full_description')</label>
									<textarea class="form-control" id="full_description" name="full_description" data-toggle="ck-editor" placeholder="@lang('admin/doctor.placeholders.full_description')">{{ old('full_description') }}</textarea>
								</div>

								@include('admin.templates.insurance-input', ['className' => 'mb-3'])

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-save"></span>
									@lang('admin/global.actions.save')
								</button>
							</div>
						</div>

						@include('admin.templates.dropzone-images')
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">

						<!--Feature Image-->
						@include('admin.templates.feature-image')

						<div class="card mb-3">
							<div class="card-body">
								<!--Clinics-->
								@include('admin.templates.clinic-input', ['className' => 'mb-3', 'multiple' => true])

								<!--Speciality-->
								@include('admin.templates.speciality-input', ['className' => 'mb-3'])
							</div>
						</div>

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs')
							</div>
						</div>

						<!--Contact Information-->
						@include('admin.templates.contact', ['className' => 'mt-3'])

						<!--SocialNetwork Information-->
						@include('admin.templates.social-network', ['className' => 'mt-3'])

						<!--Resume-->
						@include('admin.templates.resume', ['className' => 'mt-3'])
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/ck-editor/index.js') }}?ver={{ $resourceVersion }}"></script>
@endpush