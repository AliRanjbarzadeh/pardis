@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.popups.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="row mb-lg-3">
									<div class="col-md-6 mb-3 mb-lg-0">
										<label for="title" class="form-label">@lang('admin/popup.fields.title')</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/popup.placeholders.title')" value="{{ old('title') }}"/>
									</div>

									<div class="col-md-6 mb-3">
										<label for="type" class="form-label">@lang('admin/popup.fields.type')</label>
										<select id="type" name="type" class="w-100" data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
											<option></option>
											<option value="text" @selected(old('type') == 'text')>@lang('admin/popup.words.types.text')</option>
											<option value="image" @selected(old('type') == 'image')>@lang('admin/popup.words.types.image')</option>
										</select>
									</div>
								</div>

								<div class="mb-3">
									<label for="url" class="form-label">@lang('admin/popup.fields.url')</label>
									<input type="text" class="form-control" id="url" name="url" placeholder="@lang('admin/popup.placeholders.url')" value="{{ old('url') }}"/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/popup.fields.description')</label>
									<textarea class="form-control" id="description" name="description" data-toggle="ck-editor" placeholder="@lang('admin/popup.placeholders.description')">{{ old('description') }}</textarea>
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
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	@vite('public/assets/admin/js/ck-editor/index-vite.js')
@endpush