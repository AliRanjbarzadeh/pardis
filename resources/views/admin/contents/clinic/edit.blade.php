@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.clinics.update', $clinic) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/clinic.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/clinic.placeholders.title')" value="{{ old('title', $clinic->title) }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/clinic.fields.description')</label>
									<textarea class="form-control" id="description" name="description" data-toggle="ck-editor">{{ old('description', $clinic->description) }}</textarea>
								</div>

								@include('admin.templates.insurance-input', ['className' => 'mb-3', 'insurances' => $insurances, 'selected' => $clinic->insurances->pluck('id')->all()])

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-save"></span>
									@lang('admin/global.actions.save')
								</button>
							</div>
						</div>

						@include('admin.templates.dropzone-images', ['uploadedFiles' => $clinic->getMediaByNames('gallery')])
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">

						<!--Feature Image-->
						@include('admin.templates.feature-image', ['featureImage' => $clinic->getMediumByName('featureImage')])

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs', ['seo' => $clinic->seo])
							</div>
						</div>

						<!--Work Hour-->
						@include('admin.templates.work-hour-inputs', ['workHours' => $clinic->work_hours_for_input])

						<!--Contact Information-->
						@include('admin.templates.contact', ['className' => 'mt-3', 'contacts' => $clinic->contacts_for_input])
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/ck-editor/index.js') }}?ver={{ $resourceVersion }}"></script>
@endpush