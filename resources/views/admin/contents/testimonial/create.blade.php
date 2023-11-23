@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.testimonials.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-12">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="url" class="form-label">@lang('admin/testimonial.fields.url')</label>
									<input type="text" class="form-control" id="url" name="url" placeholder="@lang('admin/testimonial.placeholders.url')" value="{{ old('url') }}"/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/testimonial.fields.description')</label>
									<textarea class="form-control" id="description" name="description" placeholder="@lang('admin/testimonial.placeholders.description')" rows="4">{{ old('description') }}</textarea>
								</div>

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-save"></span>
									@lang('admin/global.actions.save')
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection