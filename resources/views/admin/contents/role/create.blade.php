@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-12">
						<div class="card mb-3">
							<div class="card-body">
								<div class="mb-3">
									<label for="name" class="form-label">@lang('admin/role.fields.name')</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin/role.placeholders.name')" value="{{ old('name') }}"/>
								</div>
							</div>
						</div>

						<div class="row">
							@foreach($permissionCategories as $permissionCategory)
								<div class="col-md-12">
									<div class="card mb-3">
										<div class="card-body">
											<h5 class="card-title text-dark">
												<strong>{{ $permissionCategory->name }}</strong>
											</h5>
											<div class="card-subtitle text-muted mb-3">
												<div class="form-check mb-2 mb-md-0">
													<input class="form-check-input" type="checkbox" id="all-permissions-{{ $permissionCategory->id }}" data-all-permissions="{{ $permissionCategory->id }}">
													<label class="form-check-label" for="all-permissions-{{ $permissionCategory->id }}">@lang('admin/role.words.check.all')</label>
												</div>
											</div>
											<div class="d-flex flex-wrap">
												@foreach($permissionCategory->permissions as $permission)
													<div class="form-check me-3 mb-2 mb-md-0">
														<input class="form-check-input" type="checkbox" name="permissions[perm-{{ $permission->id }}]" value="{{ $permission->id }}" id="permission-{{ $permission->id }}" data-permission-category="{{ $permissionCategory->id }}" @checked(old("permissions.perm-$permission->id", false))>
														<label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
													</div>
												@endforeach
											</div>

											@if($permissionCategory->children->isNotEmpty())
												@foreach($permissionCategory->children as $firstChild)
													<div class="mt-3">
														<h6 class="card-title mt-4 mb-3 text-dark">
															<strong>{{ $firstChild->name }}</strong>
														</h6>
														<div class="d-flex flex-wrap">
															@foreach($firstChild->permissions as $firstPermission)
																<div class="form-check me-3 mb-2 mb-md-0">
																	<input class="form-check-input" type="checkbox" name="permissions[perm-{{ $firstPermission->id }}]" value="{{ $firstPermission->id }}" id="permission-{{ $firstPermission->id }}" data-permission-category="{{ $permissionCategory->id }}" @checked(old("permissions.perm-$firstPermission->id", false))>
																	<label class="form-check-label" for="permission-{{ $firstPermission->id }}">{{ $firstPermission->name }}</label>
																</div>
															@endforeach
														</div>
													</div>

													@if($firstChild->children->isNotEmpty())
														@foreach($firstChild->children as $secondChild)
															<div class="mt-3">
																<h6 class="card-title mt-4 mb-3 text-dark">
																	<strong>{{ $secondChild->name }}</strong>
																</h6>
																<div class="d-flex flex-wrap">
																	@foreach($secondChild->permissions as $secondPermission)
																		<div class="form-check me-3 mb-2 mb-md-0">
																			<input class="form-check-input" type="checkbox" name="permissions[perm-{{ $secondPermission->id }}]" value="{{ $secondPermission->id }}" id="permission-{{ $secondPermission->id }}" data-permission-category="{{ $permissionCategory->id }}" @checked(old("permissions.perm-$secondPermission->id", false))>
																			<label class="form-check-label" for="permission-{{ $secondPermission->id }}">{{ $secondPermission->name }}</label>
																		</div>
																	@endforeach
																</div>
															</div>
														@endforeach

														@if($secondChild->children->isNotEmpty())
															@foreach($secondChild->children as $thirdChild)
																<div class="mt-3">
																	<h6 class="card-title mt-4 mb-3 text-dark">
																		<strong>{{ $thirdChild->name }}</strong>
																	</h6>
																	<div class="d-flex flex-wrap">
																		@foreach($thirdChild->permissions as $thirdPermission)
																			<div class="form-check me-3 mb-2 mb-md-0">
																				<input class="form-check-input" type="checkbox" name="permissions[perm-{{ $thirdPermission->id }}]" value="{{ $thirdPermission->id }}" id="permission-{{ $thirdPermission->id }}" data-permission-category="{{ $permissionCategory->id }}" @checked(old("permissions.perm-$thirdPermission->id", false))>
																				<label class="form-check-label" for="permission-{{ $thirdPermission->id }}">{{ $thirdPermission->name }}</label>
																			</div>
																		@endforeach
																	</div>
																</div>
															@endforeach
														@endif
													@endif
												@endforeach
											@endif
										</div>
									</div>
								</div>
							@endforeach
						</div>

						<button type="submit" class="btn btn-primary mt-3 w-25">
							<span class="tf-icon bx bx-save"></span>
							@lang('admin/global.actions.save')
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/pages/roles/form.js') }}?ver={{ $resourceVersion }}"></script>
@endpush
