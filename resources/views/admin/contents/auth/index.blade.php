@extends('admin.layouts.auth.master')

@section('content')
	<div class="authentication-wrapper authentication-basic container-p-y">
		<div class="authentication-inner">
			<!-- Register -->
			<div class="card">
				<div class="card-body">
					<!-- Logo -->
					<div class="app-brand justify-content-center">
						<span class="app-brand-link gap-2">
							<span class="app-brand-logo demo">
								<img src="{{ asset('assets/admin/img/logo.png') }}" alt="{{ config('app.name') }}">
							</span>
							<span class="app-brand-text demo text-body fw-bolder">{{ config('app.name') }}</span>
						</span>
					</div>
					<!-- /Logo -->
					<h4 class="mb-2">@lang('admin/auth.title')</h4>
					<p class="mb-4">@lang('admin/auth.description')</p>

					@error('message')
					<div class="alert alert-danger alert-dismissible" role="alert">
						{{ $message }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
						</button>
					</div>
					@enderror

					<form class="mb-3 needs-validation" action="{{ route('admin.auth.verify') }}" method="POST" novalidate>
						@method('POST')
						@csrf

						<div class="mb-3">
							<label for="username" class="form-label">@lang('admin/auth.fields.username')</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="@lang('admin/auth.placeholders.username')" value="{{ old('username') }}" autofocus required>
						</div>

						<div class="mb-3 form-password-toggle">
							<div class="d-flex justify-content-between">
								<label class="form-label" for="password">@lang('admin/auth.fields.password')</label>
							</div>
							<div class="input-group input-group-merge">
								<input type="password" id="password" class="form-control" name="password" placeholder="@lang('admin/auth.placeholders.password')" aria-describedby="password" required/>
								<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
							</div>
						</div>

						<div class="mb-3">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="remember-me" name="remember">
								<label class="form-check-label" for="remember-me">@lang('admin/auth.fields.remember_me')</label>
							</div>
						</div>
						<div class="mb-3">
							<button class="btn btn-primary d-grid w-100" type="submit">@lang('admin/auth.buttons.login')</button>
						</div>
					</form>
				</div>
			</div>
			<!-- /Register -->
		</div>
	</div>
@endsection

@push('styles')
	<link rel="stylesheet" href="{{ asset("assets/admin/vendor/css/pages/page-auth.css") }}">
@endpush

@push('scripts')
	<script src="{{ asset('assets/admin/vendor/libs/jbvalidator/jbvalidator.min.js') }}"></script>
	<script src="{{ asset('assets/admin/js/pages/auth/index.js') }}"></script>
@endpush