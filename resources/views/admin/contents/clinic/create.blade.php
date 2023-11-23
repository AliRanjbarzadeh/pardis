@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.clinics.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/clinic.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/clinic.placeholders.title')" value="{{ old('title') }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/clinic.fields.description')</label>
									<textarea class="form-control" id="description" name="description" data-toggle="ck-editor">{{ old('description') }}</textarea>
								</div>

								@include('admin.templates.insurance-input', ['className' => 'mb-3', 'insurances' => $insurances])

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

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs')
							</div>
						</div>

						<!--Work Hour-->
						@include('admin.templates.work-hour-inputs')

						<!--Contact Information-->
						@include('admin.templates.contact', ['className' => 'mt-3'])
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/ck-editor/index.js') }}?ver={{ $resourceVersion }}"></script>
@endpush