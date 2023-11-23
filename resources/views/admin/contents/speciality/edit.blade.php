@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.specialities.update', $speciality) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="name" class="form-label">@lang('admin/speciality.fields.name')</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin/speciality.placeholders.name')" value="{{ old('name', $speciality->name) }}" data-seo-title data-seo-link/>
								</div>

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-refresh"></span>
									@lang('admin/global.actions.update')
								</button>
							</div>
						</div>
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">
						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs', ['seo' => $speciality->seo])
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection