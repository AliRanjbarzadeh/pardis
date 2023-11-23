<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, user-scalable=no"/>
<!--========= Favicon File ======-->
<link rel="SHORTCUT ICON" href="{{ asset('assets/logo.png') }}"/>
<!--====================seo=======================-->
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
<link rel="canonical" href="{{ request()->fullUrl() }}">

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
	<meta name="twitter:image" content="{{ asset('assets/front/images/logo.png') }}"/>

	<meta name="keywords" content="{{ $seo->keywords }}">
	<meta name="description" content="{{ $seo->description }}">
	<meta name="abstract" content="{{ $seo->description }}"/>
@endif

{{ \Diglactic\Breadcrumbs\Breadcrumbs::view('front.layouts.breadcrumb-json') }}

@if(isset($breadcrumbs) && !empty($breadcrumbs))
	<!-- #### Breadcrumbs #### -->
	<script type="application/ld+json">
		{
			"@context": "https://schema.org/",
			"@type": "BreadcrumbList",
			"itemListElement": [
		@foreach($breadcrumbs as $breadcrumb)
			{
			 "@type": "ListItem",
			 "position": {{ $loop->iteration }},
		 "name": "{{ $breadcrumb['title'] }}",
		 "item": "{{ $breadcrumb['link'] }}"
		}{{ $loop->last ? '' : ',' }}
		@endforeach
		]
	}
	</script>
@endif
