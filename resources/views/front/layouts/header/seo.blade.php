<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, user-scalable=no"/>
<!--========= Favicon File ======-->
<link rel="SHORTCUT ICON" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
<!--====================SEO=======================-->
<meta name="application-name" content="">
<meta name="theme-color" content="#974784"/>
<meta name="msapplication-navbutton-color" content="#974784">
<meta name="apple-mobile-web-app-status-bar-style" content="#974784">
<meta name="application-name" content="{{ getSetting('app.name') }}">
<meta name="theme-color" content="#974784"/>
<meta name="msapplication-navbutton-color" content="#974784">
<meta name="apple-mobile-web-app-status-bar-style" content="#974784">
<meta name="format-detection" content="telephone=no"/>
<meta name="url" content="{{ request()->fullUrl() }}">

@if(isset($ampUrl))
	<link rel="amphtml" href="{{ $ampUrl }}">
@endif

@if(isset($seo))
	<!-- ############# SEO ############ -->
	<meta property="og:url" content="{{ url()->current() }}"/>
	<meta property="og:site_name" content="{{ $seo->title }}"/>
	<meta property="og:description" content="{{ $seo->description }}"/>
	<meta property="og:type" content="website"/>

	<meta property="og:image" content="{{ asset('assets/front/images/logo.png') }}"/>

	<meta property="og:image:width" content="134">
	<meta property="og:image:height" content="47">
	<meta property="og:title" content="{{ $seo->title }}"/>

	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:site" content="@pardisClinic">
	<meta name="twitter:title" content="{{ $seo->title }}"/>
	<meta name="twitter:description" content="{{ $seo->description }}"/>
	<meta name="twitter:image" content="{{ $seo->image_url ?? asset('assets/front/images/logo.png') }}"/>

	<meta name="keywords" content="{{ $seo->keywords }}">
	<meta name="description" content="{{ $seo->description }}">
	<meta name="abstract" content="{{ $seo->description }}"/>

	@if(!empty($seo->canonical))
		<link rel="canonical" href="{{ $seo->canonical }}">
	@else
		<link rel="canonical" href="{{ request()->fullUrl() }}">
	@endif

	@if(!$seo->robots || config('app.locale') != 'fa')
		<meta name="robots" content="noindex,nofollow">
	@else
		<meta name="robots" content="follow, index"/>
	@endif

@else
	<link rel="canonical" href="{{ request()->fullUrl() }}">
	<meta name="robots" content="follow, index"/>
@endif

@if(!request()->routeIs('index'))
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::view('front.layouts.breadcrumb-json') }}
@endif
