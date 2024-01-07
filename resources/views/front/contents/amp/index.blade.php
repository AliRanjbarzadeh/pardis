<!doctype html>
<html amp lang="fa">

<head>
	<meta charset="utf-8">
	<title>{{ $blog->seo->title }}</title>
	<meta name="language" content="FA">
	<link rel="shortcut icon" href="{{ asset('assets/front/images/logo-small.png') }}">
	<!--==============================================================-->
	<meta property="og:url" content="{{ route('blogs.show', $blog->seo->link) }}"/>
	<meta name="twitter:card" content="summary"/>
	<meta property="og:type" content="article"/>

	<meta property="og:site_name" content="{{ $blog->seo->title }}"/>
	<meta name="twitter:title" content="{{ $blog->seo->title }}"/>
	<meta property="og:title" content="{{ $blog->seo->title }}"/>

	<meta property="og:description" content="{{ $blog->seo->description }}"/>
	<meta name="twitter:description" content="{{ $blog->seo->description }}"/>
	<meta name="description" content="{{ $blog->seo->description }}">

	<meta name="keywords" content="{{ $blog->seo->keywords }}">
	<meta property="og:image" content="{{ $blog->feature_image->medium }}"/>
	<meta name="twitter:image" content="{{ $blog->feature_image->medium }}"/>
	<!--==============================================================-->

	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
	<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
	<script async custom-element="amp-font" src="https://cdn.ampproject.org/v0/amp-font-0.1.js"></script>
	<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
	<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
	<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
	<script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>


	<link rel="canonical" href="{{ route('blogs.show', $blog->seo->link) }}">
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "NewsArticle",
			"mainEntityOfPage": "{{ route('blogs.show', $blog->seo->link) }}",
        "headline": "{{ $blog->title }}",
		"description": "{{ $blog->seo->description }}",
		"datePublished":  "{{ $blog->created_at->format('Y-m-d\TH:i:s.000\Z') }}",
		"dateModified": "{{ $blog->updated_at->format('Y-m-d\TH:i:s.000\Z') }}",
		"image": {
            "@type": "ImageObject",
            "url": "{{ $blog->feature_image->url }}",
		@php $img_data = $blog->feature_image->dimension; @endphp
		@if(!is_null($img_data))
			"width": {{ $img_data[0] }},
	            "height": {{ $img_data[1] }}
		@endif
		},
		"publisher": {
			"@type": "Organization",
			"name": "Pardis Cancer Clinic",
			"logo": {
				"@type": "ImageObject",
				"url": "{{ asset('assets/front/images/logo-small.png') }}" ,
		@php $logoData = getimagesize(public_path('assets/front/images/logo-small.png')); @endphp
		@if(!is_null($logoData))
			"width": {{ $logoData[0] }},
		            "height": {{ $logoData[1] }}
		@endif
		}
	}
}
	</script>
	<style amp-boilerplate>body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }
            to {
                visibility: visible
            }
        }</style>
	<noscript>
		<style amp-boilerplate>body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }</style>
	</noscript>
	<style amp-custom>
        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: 500;
            src: url('{{ asset('assets/front/fonts/iransans/IRANSansWeb(FaNum).woff2') }}');
        }

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: bolder;
            src: url('{{ asset('assets/front/fonts/iransans/IRANSansWeb(FaNum)_Black.woff2') }}');
        }

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: 200;
            src: url('{{ asset('assets/front/fonts/iransans/IRANSansWeb(FaNum)_UltraLight.woff2') }}');
        }

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: 300;
            src: url('{{ asset('assets/front/fonts/iransans/IRANSansWeb(FaNum)_Light.woff2') }}');
        }

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: normal;
            src: url('{{ asset('assets/front/fonts/iransans/IRANSansWeb(FaNum).woff2') }}');
        }

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font-family: IRANSans;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */


        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
            background-color: #fbfbfb;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
        }

        h2 {
            font-size: 22px;
            font-weight: bold;
        }

        h3 {
            font-size: 20px;
            font-weight: bold;
        }

        h4 {
            font-size: 19px;
            font-weight: bold;
        }

        h5 {
            font-size: 18px;
            font-weight: bold;
        }

        h6 {
            font-size: 17px;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #22BDB6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 15px;
            margin-bottom: 10px;
            line-height: 35px;
        }


        body {
            font-family: 'IRANSans';
        }

        amp-img {

        }

        .nav {
            border: none;
            text-align: right;
            display: block;
            background-color: #22BDB6;
            width: 100%;
            color: #fff;
            background-image: url({{ asset('assets/front/images/amp/menu.svg') }});
            background-repeat: no-repeat;
            background-position: calc(100% - 8px) 50%;
            background-size: 30px;
            padding: 16px 45px 16px 0;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            position: fixed;
            top: 0px;
            right: 0px;
            box-shadow: 0 3px 6px -4px #000;
            z-index: 1;
            font-family: IRANSans;
            font-size: 16px;
        }

        .main {
            max-width: 768px;
            width: auto;
            height: auto;
            padding: 70px 15px 40px;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            line-height: 25px;
            margin: 0 auto;
        }

        .menu_item > li > a,
        .menu_item > li > label > a {
            text-decoration: none;
            display: block;
            padding: 13px 15px;
            color: #1b1b1b;
            border-bottom: 1px solid rgba(0, 0, 0, 0.15);
            cursor: pointer;
            font-size: 12px;
        }

        .menu_item > li {
            width: 100%;
            min-height: 43px;
            height: auto;
            overflow: hidden;
            color: #1f1f1f;
        }

        .menu_item > li > ul li a {
            text-decoration: none;
            display: block;
            padding: 13px 36px 12px 0;
            color: rgba(255, 255, 255, 0);
            font-size: 14px;
            background: rgba(0, 0, 0, 0.33);
        }

        .accordion-header {
            cursor: pointer;
            background-color: #efefef;
            padding-right: 20px;
            border: 1px solid #dfdfdf;
            font-size: 15px;
            font-weight: bold;
        }

        .accordion-content a {
            display: block;
            padding: 13px 36px 12px 0;
            color: rgba(255, 255, 255, 0.88);
            font-size: 14px;
            background: rgba(0, 0, 0, 0.33);
        }

        .menu_item > li > a:visited {
            color: inherit;
        }

        .power_by {
            width: 100%;
            padding: 20px 0;
            background-color: #121317;
        }

        .power_by p {
            text-align: center;
            color: #a0a0a0;
            margin: 0;
            font-size: 12px;
        }

        .site-logo amp-img,
        .site-logo p {
            display: inline-block;
            vertical-align: middle;
        }

        .site-logo p {
            font-size: 17px;
            font-weight: bold;
        }

        .site-logo p span {
            color: #22BDB6;
        }


        .site-logo {
            margin-bottom: 20px;
        }

        amp-img {
            width: inherit;
            height: inherit;
        }

        hr {
            border: none;
            height: 1px;
            background: #a5a5a5;
        }

        .conatin, .conatin {
            font-family: IRANSans
        }

        .conatin p {
            text-align: justify;
            color: #455A64;
            font-size: 16px;
            line-height: 35px;
            margin-bottom: 15px;
            font-family: IRANSans
        }

        .conatin h1,
        .conatin h2,
        .conatin h3,
        .conatin h4,
        .conatin h5,
        .conatin h6 {
            font-weight: 500;
            padding: 15px 0;
            height: auto;
            font-size: 20px;
            color: #2098d1;
            margin: 15px 0;
            background: url('{{ asset('assets/front/images/amp/heading-border.png') }}') left bottom repeat-x;
        }

        .conatin ul {
            -webkit-margin-before: 0;
            -webkit-margin-after: 0;
            -webkit-margin-start: 0;
            -webkit-margin-end: 0;
            -webkit-padding-start: 00px;
            -moz-margin-before: 0;
            -moz-margin-after: 0;
            -moz-margin-start: 0;
            -moz-margin-end: 0;
            -moz-padding-start: 00px;
        }

        .conatin ul li {
            display: block;
            margin: 15px 0;
        }

        .conatin ul li a, .conatin ul li {
            display: inline-block;
            vertical-align: middle;
            font-size: 16px;
            color: #00ACC1;
        }

        .conatin ul li:before {
            content: "";
            display: inline-block;
            background-image: url('{{ asset('assets/front/images/amp/check.webp') }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            vertical-align: middle;
            font-size: 16px;
            margin: 0 0 0 10px;
            width: 25px;
            height: 20px;
        }

        .pageLink2 li {
            display: block;
            padding: 8px 0;
            margin: 8px 0;
            font-size: 15px;
            border-bottom: 1px solid #eee;
            color: #546E7A;
        }

        .pageLink2 li:before {
            content: "";
            display: inline-block;
            background-image: url('{{ asset('assets/front/images/amp/care.svg') }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            vertical-align: middle;
            font-size: 16px;
            margin: 0 0 0 10px;
            width: 30px;
            height: 30px;
        }

        .text_contain .customP {
            display: table;
            width: auto;
            background: #00ACC1;
            color: #fff;
            padding: 5px 30px;
        }

        .text_contain .customP2 {
            display: table;
            width: auto;
            background: #8BC34A;
            color: #fff;
            padding: 5px 30px;
        }

        .text_contain .customP2 a {
            color: #e7ff2e;
            text-decoration: none;
        }

        .text_contain .faq .a {
            font-size: 18px;
            line-height: 45px;
            height: 45px;
            border-bottom: 2px solid #00ACC1;
            color: #00ACC1;
            display: table;
            width: auto;
            padding-left: 10px;
            margin: 0;
        }

        .own_txt p, .text_contain p {
            text-align: justify;
            color: #455A64;
            font-size: 16px;
            line-height: 35px;
        }

        .text_contain .faq .b {
            padding: 15px;
            background: rgba(238, 238, 238, .48);
        }

        .text_contain .faq .a:before {
            content: "";
            display: inline-block;
            background-image: url('{{ asset('assets/front/images/amp/plus.png') }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            vertical-align: middle;
            font-size: 16px;
            margin: 0 0 0 10px;
            width: 30px;
            height: 30px;
        }

        .Citytags a {
            display: inline-block;
            padding: 3px 10px;
            font-size: 12px;
            border-radius: 20px;
            background-color: #8BC34A;
            color: #fff;
            border: 1px solid #8BC34A;
            margin-left: 2px;
            margin-top: 8px;
            box-shadow: -2px 2px 4px 0 rgba(197, 168, 100, .73);
            transition: .4s ease all;
        }

        .text_contain .customP a {
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, .71);
            text-decoration: none;
        }

        .text_contain .spcialimage {
            float: right;
            margin-left: 10px;
        }

        .text-center {
            text-align: center;
        }

        .rating {
            --star-size: 3;
            padding: 0;
            border: none;
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: left;
            user-select: none;
            font-size: 3em;
            font-size: calc(var(--star-size) * 1em);
            cursor: pointer;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-tap-highlight-color: transparent;
            margin-bottom: 0;
        }

        /* the stars */
        .rating > label {
            display: inline-block;
            position: relative;
            width: 1.1em;
            width: calc(var(--star-size) / 3 * .9em);
        }

        .rating > *:hover,
        .rating > *:hover ~ label,
        .rating:not(:hover) > input:checked ~ label {
            color: transparent;
            cursor: inherit;
        }

        .rating > *:hover:before,
        .rating > *:hover ~ label:before,
        .rating:not(:hover) > input:checked ~ label:before {
            content: "★";
            position: absolute;
            left: 0;
            color: gold;
        }

        .rating > input {
            position: relative;
            transform: scale(3);
            transform: scale(var(--star-size));

            top: -0.5em;
            top: calc(var(--star-size) / 6 * -1em);
            margin-left: -2.5em;
            margin-left: calc(var(--star-size) / 6 * -5em);
            z-index: 2;
            opacity: 0;
            font-size: initial;
        }

        form.amp-form-submit-error [submit-error] {
            color: red;
        }

        .amplabel {
            display: block;
            padding: 15px 0;
        }

        .amplabel input {
            display: block;
            width: 100%;
            border: none;
            background-color: transparent;
            height: 40px;
            border-bottom: 2px solid #222;
            outline: none;
            font-family: IRANSans;
        }

        .amplabel textarea {
            display: block;
            width: 100%;
            height: 90px;
            border: none;
            background-color: transparent;
            border-bottom: 2px solid #526d7e;
            outline: none;
            font-family: IRANSans;
        }

        .amplabel input[type="submit"] {
            border: none;
            background-color: #7ac020;
            color: #ffffff;
            width: 40%;
            text-align: center;
            /* padding: 15px; */
            display: inline-block;
            float: left;

        }

        .agre-rate {
            margin: 15px 0 0;
        }

        form.amp-form-submit-success [submit-success] {
            color: green;
        }

        .blog_time {
            font-size: 12px;
            color: #626c77;
            text-align: left;
        }

        hr {
            border: none;
            height: 1px;
            background: rgb(217, 217, 217);
        }

        .clear {
            clear: both;
            display: block;
        }

        .commentslist {

        }

        .commentslist .commentsOne {
            padding: 15px 0;
            border-bottom: 1px solid #e1e1e1;
        }

        .commentslist .commentsOne:last-child {
            border-bottom: none;
        }

        .commentslist .commentsOne.replay {
            border-top: 1px solid #eee;
            border-bottom: none;
            background-color: #eee;
            margin-top: 15px;
        }

        .commentslist img {

            object-fit: cover;
            object-position: center;
        }

        .commentslist img {

            border-radius: 50%;
        }

        .commentslist .info {
            display: inline-block;
            width: calc(100% - 80px);
            vertical-align: top;
        }

        .commentslist .info {
            padding-right: 15px;
            box-sizing: border-box;
        }

        .commentslist .info h4 {
            font-size: 15px;
            font-weight: 300;
            margin: 0px;

        }

        .commentslist .info time {
            font-size: 12px;
            font-weight: 300;
            color: #b2b1b1;
        }

        .commentslist .info p {
            font-size: 12px;
            font-weight: 300;
            color: #625b5b;
        }

        img {
            object-fit: contain;
            object-position: center;
        }

        .social-sharing {
            padding: 0 15px;
        }

        .menu_item {
            min-width: 180px;
        }

        amp-sidebar {
            background-color: #f8f8f8;
            color: #fff;
        }

        .menuLogo {
            text-align: center;
            margin: 10px 0 0;
        }

        .backToHome {
            color: #fff;
            font-size: 14px;
            padding: 21px 15px;
            background: #22BDB6;
        }

        .backToHome:before {
            margin-left: 10px;
            content: "";
            width: 15px;
            height: 15px;
            display: inline-block;
            vertical-align: middle;
            background-image: url('{{ asset('assets/front/images/amp/right-arrow-forward.png') }}');
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
	</style>
</head>

<body dir="rtl">

<amp-sidebar id='sidebar' layout="nodisplay" side="right">
	<nav>
		<div class="backToHome" on="tap:sidebar.close" role="button" tabindex="0">بستن منو</div>
		<ul class="menu_item">
			<li>
				<a href="{{ route('index') }}">خانه</a>
			</li>
			<li>
				<a href="{{ route('services.index') }}" title="">خدمات</a>
			</li>
			<li>
				<a href="{{ route('clinics.index') }}" title="">کلینک های تخصصی</a>
			</li>
			{{--			<li>--}}
			{{--				<a href="<?php echo base_url('club/register'); ?>" title="">باشگاه پردیس</a>--}}
			{{--			</li>--}}
			<li>
				<a href="{{ route('blogs.index') }}" title="">بلاگ</a>
			</li>
			<li>
				<a href="{{ route('about') }}" title="">درباره ی ما</a>
			</li>
			<li>
				<a href="{{ route('contact.index') }}" title="">تماس با ما</a>
			</li>
			<li>
				<a href="http://5.160.173.8/Center/LabAnswerwm" title="">جواب دهی آزمایش</a>
			</li>
		</ul>
		<div class="menuLogo">
			<amp-img width="80px" height="80px" src="{{ asset('assets/front/images/amp/logo-verical.png') }}" alt="کلینک تخصصی سرطان پردیس"></amp-img>
		</div>
	</nav>
</amp-sidebar>
<div class="container">
	<button class="nav" on='tap:sidebar.open'>
		<label>منو</label>
	</button>
	<div class="main">
		<div class="site-logo text-center">
			<amp-img width="160px" height="60px" src="{{ asset('assets/front/images/amp/logo-verical.png') }}"></amp-img>
			<p>
				<span> کلینک تخصصی سرطان پردیس </span>
			</p>
		</div>
		<hr>
		<h1>{{ $blog->title }}</h1>
		<amp-img src="{{ $blog->feature_image->url }}" width="4" height="3" layout="responsive" alt="{{ $blog->title }}"></amp-img>
		<div class="conatin">
			{!! $blog->ampify_description !!}
		</div>
		<div class="blog_time text-left"> تاریخ مطلب :
			{{ $blog->getCreatedAtFormatted('j F Y R G:i') }}
		</div>
		<hr>
		<h4 class="title1"> به این مطلب امتیاز دهید : </h4>
		<div class="agre-rate">
			<form id="rating" class="p2" method="post" action-xhr="{{ route('amp.rate', $blog) }}"
			      target="_blank">
				@csrf
				<fieldset class="rating">
					<input name="rating" type="radio" id="rating5" value="5" on="change:rating.submit" <?php if ($blog->rate_average == 5) echo
					'checked' ?> />
					<label for="rating5" title="5 stars">☆</label>

					<input name="rating" type="radio" id="rating4" value="4" on="change:rating.submit" <?php if ($blog->rate_average == 4) echo
					'checked' ?> />
					<label for="rating4" title="4 stars">☆</label>

					<input name="rating" type="radio" id="rating3" value="3" on="change:rating.submit" <?php if ($blog->rate_average == 3) echo
					'checked' ?> />
					<label for="rating3" title="3 stars">☆</label>

					<input name="rating" type="radio" id="rating2" value="2" on="change:rating.submit" <?php if ($blog->rate_average == 2) echo
					'checked' ?> />
					<label for="rating2" title="2 stars">☆</label>

					<input name="rating" type="radio" id="rating1" value="1" on="change:rating.submit" <?php if ($blog->rate_average == 1) echo
					'checked' ?> />
					<label for="rating1" title="1 stars">☆</label>
				</fieldset>
				<div class="color-green" submit-success>
					<template type="amp-mustache">
						<p>@php echo '{{msg}}{{rating}}'; @endphp</p>
					</template>
				</div>
				<div submit-error>
					<template type="amp-mustache">
						<p>@php echo '{{msg}}'; @endphp</p>
					</template>
				</div>
			</form>
		</div>
		<!--==================comment====================-->
		<br>
		<hr>
		<h4> نظر خود را در مورد این مطلب بیان کنید . </h4>
		<form method="post" class="p2" action-xhr="{{ route('amp.comment', $blog) }}" target="_top"
		      custom-validation-reporting="as-you-go">
			@csrf
			<input name="canonicalUrl" type="hidden" value="CANONICAL_URL-<?php echo rand(); ?>" data-amp-replace="CANONICAL_URL RANDOM">
			<input name="clientId" type="hidden" value="CLIENT_ID(myid)" data-amp-replace="CLIENT_ID">

			<div class="ampstart-input inline-block relative m0 p0 mb3">
				<div class="amplabel">
					<input type="text" class="block border-none p0 m0" id="as-you-go-name" name="name" placeholder="نام و نام خانوادگی"
					       required>
					<span visible-when-invalid="valueMissing" validation-for="as-you-go-name"> لطفا نام و نام خانوادگی خود را وارد
							کنید (مثلا : رضا دهقان) </span>

				</div>
				<div class="amplabel">
					<input type="email" class="block border-none p0 m0" id="as-you-go-email" name="email" placeholder="پست الکترونیک"
					       required>
					<span visible-when-invalid="valueMissing" validation-for="as-you-go-email"> لطفا پست الکترونیک خود را وارد کنید
						</span>
					<span visible-when-invalid="typeMismatch" validation-for="as-you-go-email"> پست ااکترونیک وارد شده معتبر نیست
						</span>
				</div>
				<div class="amplabel">
					<textarea class="block border-none p0 m0" id="as-you-go-text" name="comment" placeholder="نظر شما" required></textarea>
					<span visible-when-invalid="valueMissing" validation-for="as-you-go-text">فیلد نظر شما اجباری است .</span>

				</div>

			</div>
			<div class="amplabel">
				<input type="submit" value="ارسال نظر" class="ampstart-btn caps">
			</div>
			<div class="clear"></div>
			<div submit-success>
				<template type="amp-mustache">
					کاربر گرامی @php echo '{{name}}'; @endphp نظر شما با موفقیت ثبت شد
				</template>
			</div>
			<div submit-error>
				<template type="amp-mustache">@php echo '{{msg}}'; @endphp</template>
			</div>
		</form>
		<!--======================================-->
		<div class="commentslist">
			<?php foreach ($blog->comments as $comment) { ?>
			<div class="commentsOne">
				<amp-img width="70" height="70" alt="<?php echo $comment->full_name; ?>" src="<?php echo \App\Helpers\General::get_gravatar($comment->email); ?>"></amp-img>
				<div class="info">
					<h4>
							<?php echo $comment->full_name; ?>
					</h4>
					<time>
							<?php echo $comment->getCreatedAtFormatted('j F o'); ?> </time>
					<p>
							<?php echo $comment->body; ?>
					</p>
				</div>
{{--					<?php foreach ($reply_comments as $response) {--}}
{{--				if ($row->id == $response->comment_id) { ?>--}}
{{--				<div class="commentsOne replay">--}}
{{--					<amp-img width="70" height="70" alt="<?php echo $response->author; ?>" src="<?php echo \App\Helpers\General::get_gravatar($response->admin_email); ?>"></amp-img>--}}
{{--					<div class="info">--}}
{{--						<h4>--}}
{{--								<?php echo $response->author . ' (مدیر سایت) '; ?>--}}
{{--						</h4>--}}
{{--						<time>--}}
{{--								<?php echo $response->per_date; ?> </time>--}}
{{--						<p>--}}
{{--								<?php echo $response->response; ?>--}}
{{--						</p>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<?php }--}}
{{--				} ?>--}}
			</div>
			<?php } ?>


		</div>
		<!--======================================-->
		<br>
		<hr>
		<br>
		<div class="social-sharing">
			<h4 class="title1">به اشتراک گذاری در : </h4>
			<amp-social-share type="twitter"></amp-social-share>
			<amp-social-share type="gplus"></amp-social-share>
			<amp-social-share type="email"></amp-social-share>
			<amp-social-share type="pinterest"></amp-social-share>
			<amp-social-share type="linkedin"></amp-social-share>
			<amp-social-share type="facebook" data-param-app_id="1068623149930251"></amp-social-share>
			<amp-social-share type="tumblr"></amp-social-share>
		</div>
	</div>
</div>
<div class="power_by">
	<p>
		طراحی و توسعه توسط
		<a href="https://afrandev.com/" title="افران" target="_blank">افران</a>
	</p>
</div>
</body>

</html>