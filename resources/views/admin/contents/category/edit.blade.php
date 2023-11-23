@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.categories.'.request()->segment(3).'.update', $category) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="row">
									<div class="col-md-6 mb-3">
										<label for="name" class="form-label">@lang('admin/category.fields.name')</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin/category.placeholders.name')" value="{{ old('name', $category->name) }}" data-seo-title data-seo-link/>
									</div>

									<div class="col-md-6 mb-3">
										<label for="priority" class="form-label">@lang('admin/global.fields.priority')</label>
										<input type="number" class="form-control" id="priority" name="priority" placeholder="@lang('admin/global.placeholders.priority')" min="1" max="9999" value="{{ old('priority', $category->priority) }}"/>
									</div>
								</div>

								<input type="hidden" name="type" value="{{ request()->segment(3) }}">
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

								@include('admin.templates.seo-inputs', ['seo' => $category->seo])
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection