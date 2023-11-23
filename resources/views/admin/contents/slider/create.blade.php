@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.'.request()->segment(2).'.sliders.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="row mb-3">
									<div class="col-md-6 mb-sm-3">
										<label for="title" class="form-label">@lang('admin/slider.fields.title')</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/slider.placeholders.title')" value="{{ old('title') }}"/>
									</div>

									<div class="col-md-6">
										<label for="priority" class="form-label">@lang('admin/global.fields.priority')</label>
										<input type="number" class="form-control" id="priority" name="priority" min="{{ config('global.input.priority.min') }}" max="{{ config('global.input.priority.max') }}" placeholder="@lang('admin/global.placeholders.priority')" value="{{ old('priority') }}"/>
									</div>
								</div>

								<div class="mb-3">
									<label for="link" class="form-label">@lang('admin/slider.fields.link')</label>
									<input type="text" class="form-control" id="link" name="link" placeholder="@lang('admin/slider.placeholders.link')" value="{{ old('link') }}"/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/slider.fields.description')</label>
									<textarea class="form-control" id="description" name="description" placeholder="@lang('admin/slider.placeholders.description')" rows="4">{{ old('description') }}</textarea>
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
						@include('admin.templates.feature-image', ['name' => __('admin/slider.words.choose')])
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection