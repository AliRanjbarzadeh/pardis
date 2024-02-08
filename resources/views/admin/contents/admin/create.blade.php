@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="name" class="form-label">@lang('admin/admin.fields.name')</label>
									<input type="text" class="form-control" id="name" name="name" placeholder="@lang('admin/admin.placeholders.name')" value="{{ old('name') }}"/>
								</div>

								<div class="row">
									<div class="col-md-4 mb-3">
										<label for="username" class="form-label">@lang('admin/admin.fields.username')</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="@lang('admin/admin.placeholders.username')" value="{{ old('username') }}"/>
									</div>

									<div class="col-md-4 mb-3">
										<label for="password" class="form-label">@lang('admin/admin.fields.password')</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="@lang('admin/admin.placeholders.password')" autocomplete="new-password"/>
									</div>

									<div class="col-md-4 mb-3">
										<label for="re_password" class="form-label">@lang('admin/admin.fields.re_password')</label>
										<input type="password" class="form-control" id="re_password" name="re_password" placeholder="@lang('admin/admin.placeholders.re_password')" autocomplete="new-password"/>
									</div>
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

						<!--Roles-->
						<div class="card">
							<div class="card-body">
								<label for="role_id" class="form-label">@lang('admin/role.singular')</label>
								<select id="role_id" name="role_id" class="select2 w-100" data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
									<option></option>
									@foreach($roles as $role)
										<option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ $role->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection