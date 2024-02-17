@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/blog.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/blog.placeholders.title')" value="{{ old('title') }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/blog.fields.description')</label>
									<textarea class="form-control" id="description" name="description" data-toggle="ck-editor" placeholder="@lang('admin/blog.placeholders.description')">{{ old('description') }}</textarea>
								</div>

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-save"></span>
									@lang('admin/global.actions.save')
								</button>
							</div>
						</div>
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">
						<!--Feature Image-->
						@include('admin.templates.feature-image')

						<div class="card mb-3">
							<div class="card-body">
								<!--Category-->
								@include('admin.templates.category-input', ['className' => 'mb-3'])

								<!--Tags-->
								@include('admin.templates.tags-input', ['className' => 'mb-3'])

								<!--Clinic-->
								@include('admin.templates.clinic-input', ['className' => 'mb-3'])

								<!--Doctor-->
								@include('admin.templates.doctor-input')
							</div>
						</div>

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs')
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	@vite('public/assets/admin/js/ck-editor/index-vite.js')
@endpush