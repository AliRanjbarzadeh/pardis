<!DOCTYPE html>
<html lang="fa" class="light-style layout-menu-fixed " dir="rtl" data-theme="theme-default" data-assets-path="{{ public_path("assets/admin/admin") }}/" data-template="vertical-menu-template-free">

<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>{{ $title ?? '' }} | {{ config('app.name') }}</title>

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{ asset("assets/favicon.ico") }}"/>

	<!-- Core CSS -->
	@include('admin.layouts.styles')

	<!-- Page CSS -->
	@stack('styles')

	<script type="text/javascript">
		window.baseUrl = '{{ url('') }}';
	</script>

	<!-- Helpers -->
	<script src="{{ asset("assets/admin/vendor/js/helpers.js") }}"></script>
	<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="{{ asset("assets/admin/js/config.js") }}"></script>
</head>

<body dir="rtl">
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
	<div class="layout-container">
		<!-- Menu -->
		@include('admin.layouts.aside-menu')
		<!-- / Menu -->

		<!-- Layout container -->
		<div class="layout-page">

			<!-- Navbar -->
			@include('admin.layouts.user-menu')
			<!-- / Navbar -->

			<!-- Content wrapper -->
			<div class="content-wrapper">

				<!-- Content -->
				<div class="container-xxl flex-grow-1 container-p-y">

					{{ \Diglactic\Breadcrumbs\Breadcrumbs::render() }}

					@if($errors->any() || session()->has('success'))
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
							</symbol>
							<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
							</symbol>
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol>
						</svg>

						@if(session()->has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
									<use xlink:href="#check-circle-fill"/>
								</svg>
								<strong>{{ session()->get('success') }}</strong>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if($errors->isNotEmpty())
							@foreach($errors->all() as $error)
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
										<use xlink:href="#exclamation-triangle-fill"/>
									</svg>
									<strong>{{ $error }}</strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							@endforeach
						@endif
					@endif

					@yield('content')
				</div>
				<!-- / Content -->

				<!-- Footer -->
				@include('admin.layouts.footer')
				<!-- / Footer -->

				<div class="content-backdrop fade"></div>
			</div>
			<!-- Content wrapper -->
		</div>
		<!-- / Layout page -->
	</div>
	<!-- Overlay -->
	<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
@include('admin.layouts.scripts')

<!-- Page JS -->
@stack('scripts')

<!-- Place this tag in your head or just before your close body tag. -->
<script src="{{ asset("assets/admin/vendor/js/buttons.js") }}"></script>

@include('admin.layouts.modals')
@stack('modals')
</body>

</html>