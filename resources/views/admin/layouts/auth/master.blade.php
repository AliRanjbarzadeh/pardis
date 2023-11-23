<!DOCTYPE html>
<html lang="fa" class="light-style layout-menu-fixed " dir="rtl" data-theme="theme-default" data-assets-path="{{ asset("") }}" data-template="vertical-menu-template-free">

<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>@lang('admin/auth.singular') | {{ config('app.name') }}</title>
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{ asset("assets/favicon.ico") }}"/>

	<!-- Core CSS -->
	@include('admin.layouts.styles')

	<!-- Page CSS -->
	@stack('styles')

	<!-- Helpers -->
	<script src="{{ asset("assets/admin/vendor/js/helpers.js") }}"></script>
	<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="{{ asset("assets/admin/js/config.js") }}"></script>
	<script>
        config.url = '{{ url('') }}';
        config.assetUrl = '{{ asset('') }}';
	</script>
</head>

<body dir="rtl">

<div class="container-xxl">
	@yield('content')
</div>

<!-- Core JS -->
@include('admin.layouts.scripts')

<!-- Page JS -->
@stack('scripts')

<!-- Place this tag in your head or just before your close body tag. -->
<script src="{{ asset("assets/admin/vendor/js/buttons.js") }}"></script>
</body>

</html>