<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') == 'en' ? 'ltr' : 'rtl' }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="baseUrl" content="{{ url('') }}">

	@include('front.layouts.header.seo')

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon"/>

	<!-- Styles -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
	<link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.css"/>
	@vite('resources/css/app.scss')
	@stack('styles')

	@if(request()->routeIs('index'))
		<title>{{ $pageTitle ?? config('app.name') }}</title>
	@else
		<title>{{ ($pageTitle ?? '') . ' | ' . config('app.name') }}</title>
	@endif
</head>
<body>
<div class="flex flex-col justify-between min-h-screen">
	<div>
		@include('front.layouts.header.navbar')
		@yield('content')
	</div>
	@include('front.layouts.footer.footer')
</div>

<script type="text/javascript" src="{{ asset('assets/shared/js/translations-' . config('app.locale') . '.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/shared/js/router-' . config('app.locale') . '.js') }}"></script>

@vite('resources/js/app.js')
<script type="text/javascript" src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>

@stack('scripts')
</body>
</html>