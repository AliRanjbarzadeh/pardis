@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.insurances.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="name" class="form-label">@lang('admin/insurance.fields.name')</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin/insurance.placeholders.name')" value="{{ old('name') }}"/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/insurance.fields.description')</label>
									<textarea class="form-control" id="description" name="description" placeholder="@lang('admin/insurance.placeholders.description')" rows="4">{{ old('description') }}</textarea>
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

						<!--Categories-->
						@foreach($categories as $category)
							<h5>{{ $category->name }}</h5>
							<div class="card mb-4">
								<ul class="list-group list-group-flush">
									@foreach($category->categories as $child)
										<li class="list-group-item">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="child{{ $child->id }}" name="categories[]" value="{{ $child->id }}" @checked(in_array($child->id, old('categories', [])))>
												<label class="form-check-label" for="child{{ $child->id }}">{{ $child->name }}</label>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection