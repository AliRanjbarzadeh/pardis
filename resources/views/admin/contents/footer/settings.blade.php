@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.footer.settings.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/setting.fields.footer.description')</label>
									<textarea class="form-control" id="description" name="description" rows="4" placeholder="@lang('admin/setting.placeholders.footer.description')">{{ old('description', getSetting('footer_description')) }}</textarea>
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
						<!--Links-->
						@include('admin.templates.link-input', ['links' => getSetting('footer_links')])
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection