@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.services.update', $service) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/service.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/service.placeholders.title')" value="{{ old('title', $service->title) }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/service.fields.description')</label>
									<textarea class="form-control" id="description" name="description" placeholder="@lang('admin/service.placeholders.description')" rows="4">{{ old('description', $service->description) }}</textarea>
								</div>

{{--								<div>--}}
{{--									<label for="full_description" class="form-label">@lang('admin/service.fields.full_description')</label>--}}
{{--									<textarea class="form-control" id="full_description" name="full_description" data-toggle="ck-editor">{{ old('full_description', $service->full_description) }}</textarea>--}}
{{--								</div>--}}

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-refresh"></span>
									@lang('admin/global.actions.update')
								</button>
							</div>
						</div>

{{--						@include('admin.templates.dropzone-images', ['uploadedFiles' => $service->getMediaByNames('gallery')])--}}
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">

						<!--Feature Image-->
						@include('admin.templates.feature-image', ['featureImage' => $service->getMediumByName('featureImage')])

						<!--Icon Image-->
						@include('admin.templates.icon-image', ['iconImage' => $service->getMediumByName('iconImage')])

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs', ['seo' => $service->seo])
							</div>
						</div>

						<!--Faq-->
{{--						<div>--}}
{{--							@include('admin.templates.faq-inputs', ['faqs' => $service->faqs_for_input])--}}
{{--						</div>--}}
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/ck-editor/index.js') }}?ver={{ $resourceVersion }}"></script>
@endpush