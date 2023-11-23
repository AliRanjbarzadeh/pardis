@extends('admin.layouts.master')

@section('content')
	@php
		$routes = old('routes', $routes ?? []);
	@endphp

	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.communications.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-12">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/communication.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/communication.placeholders.title')" value="{{ old('title') }}"/>
								</div>

								<div class="d-flex flex-column mb-3">
									<div id="routes" class="row">
										<h5 class="col-12">@lang('admin/communication.words.path.plural')</h5>

										@if(!empty($routes))
											@foreach($routes as $route)
												<div class="col-md-6 mt-3" data-lines="{{ $loop->index }}">
													<h6>@lang('admin/communication.words.path.head', ['num'=> $loop->iteration])</h6>
													<div class="d-flex align-items-center">
														<h6 class="m-0 flex-grow-1">@lang('admin/communication.words.path.sub.plural')</h6>
														<button type="button" class="btn btn-primary" onclick="addSubPath(this)" data-index="{{ $loop->index }}">
															<span class="tf-icons bx bx-plus"></span>
															@lang('admin/communication.words.path.sub.add')
														</button>
													</div>
													@foreach($route['lines'] as $line)
														<input type="text" name="routes[{{ $loop->parent->index }}][lines][]" class="form-control mt-3" placeholder="@lang('admin/communication.placeholders.routes.path_line_text')" value="{{ $line }}">
													@endforeach
												</div>
											@endforeach
										@else
											<div class="col-md-6 mt-3" data-lines="0">
												<h6>@lang('admin/communication.words.path.head', ['num'=> 1])</h6>
												<div class="d-flex align-items-center">
													<h6 class="m-0 flex-grow-1">@lang('admin/communication.words.path.sub.plural')</h6>
													<button type="button" class="btn btn-primary" onclick="addSubPath(this)" data-index="0">
														<span class="tf-icons bx bx-plus"></span>
														@lang('admin/communication.words.path.sub.add')
													</button>
												</div>
												<input type="text" name="routes[0][lines][]" class="form-control mt-3" placeholder="@lang('admin/communication.placeholders.routes.path_line_text')">
											</div>
										@endif
									</div>

									<button type="button" class="btn btn-info mt-3 w-25 align-self-end" onclick="addPath(this)">
										<span class="tf-icons bx bx-plus"></span>
										@lang('admin/communication.words.path.add')
									</button>
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

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/pages/routes/paths.js') }}?ver={{ $resourceVersion }}"></script>
@endpush
