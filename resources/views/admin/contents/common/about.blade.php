@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.about.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/about.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/about.placeholders.title')" value="{{ old('title', $page?->title) }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/about.fields.description')</label>
									<textarea class="form-control" id="description" name="description" placeholder="@lang('admin/about.placeholders.description')" rows="4">{{ old('description', $page?->description) }}</textarea>
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
						@include('admin.templates.feature-image', ['featureImage' => $page?->feature_image])

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs', ['seo' => $page?->seo])
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection