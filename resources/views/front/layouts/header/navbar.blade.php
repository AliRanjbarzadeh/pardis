<div class="bg-primary-950 text-white py-2 hidden md:block">
	<div class="custom-container">
		<div class="flex justify-between opacity-80">
			<div class="flex items-center">
				<div class="flex items-center me-4 md:text-xs lg:text-sm">
					<span class="material-symbols-outlined me-2">apartment</span>
					<span>{{ $contactInfo->getMetaValue('address') }}</span>
				</div>
				@php
					$phones = explode('-', $contactInfo->getMetaValue('phones'));
				@endphp
				@if(!empty($phones))
					<div class="flex items-center md:text-xs lg:text-sm">
						<span class="material-symbols-outlined me-2">call</span>
						<a class="hover:underline" href="tel:{{ $phones[0] }}">{{ $phones[0] }}</a>
					</div>
				@endif
			</div>
			<div class="flex gap-2 items-center">
				@foreach($contactInfo->socialNetworks as $socialNetwork)
					<a class="w-5 h-5" href="{{ $socialNetwork->address_url }}">
						@include('front.shared.icons.' . $socialNetwork->socialNetworkType->icon, ['fill' => '#fff'])
					</a>
				@endforeach

				@include('front.layouts.header.language-switch')
			</div>
		</div>
	</div>
</div>

<header class="text-sm sticky top-0 z-[9999999]">
	<div class="py-4 md:hidden bg-primary-950 text-white">
		<!-- navbar -->
		<nav class="flex flex-row items-center justify-between px-1">
			<div class="flex items-center">
				<button class="px-4 flex" id="mobile-menu-button">
					<span class="text-3xl material-symbols-outlined menu-ii">menu</span>
					<span class="text-3xl material-symbols-outlined hidden close-ii">arrow_forward</span>
				</button>
				<a href="">
					<img class="h-[35px]" src="{{ asset('assets/front/images/mobile-logo.png') }}">
				</a>
			</div>
			<div class="flex flex-row justify-end items-center">
				<div class="px-4">
					@include('front.layouts.header.language-switch')
				</div>
			</div>
		</nav>
	</div>

	<nav class="bg-white hidden md:block">
		<div class="custom-container py-3 lg:py-4 flex items-center justify-between">
			<div class="flex items-center w-full justify-between lg:justify-normal">
				<ul class="flex items-center gap-1 lg:gap-2">
					@foreach($menus as $menu)
						@include('front.layouts.header.menu-item', ['menu' => $menu])
					@endforeach
				</ul>
				<a href="https://rpn.one/pardisoncology/booking" class="btn btn-primary btn-outline ms-5 px-3 py-2">
					نوبت دهی آنلاین
				</a>
			</div>
			<div class="hidden lg:block">
				<img src="{{ asset('assets/front/images/logo.png') }}" alt="{{ config('app.name') }}">
			</div>
		</div>
	</nav>
</header>

@include('front.layouts.header.mobile-nav')

@if(!request()->routeIs('index'))
	{{ \Diglactic\Breadcrumbs\Breadcrumbs::view('front.layouts.breadcrumb') }}
@endif

