@extends('front.layouts.master')

@section('content')
	<main class="pt-14">
		<div class="custom-container">
			@include('front.shared.section-title', [
				'title' => __('front/contact_info.words.contact'),
				'class' => 'mb-10',
			])
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-11 mb-14">
				<div id="map" class="h-[335px] xl:h-[411px] rounded-3xl shadow-btn1 overflow-hidden"></div>
				<span id="map-location" class="hidden">{{ $page->getMetaValue('location', true) }}</span>
				<div>
					<h2 class="font-bold text-2xl mb-8">{{ $page->getMetaValue('side_title') ?? __('front/contact_info.words.communication') }}</h2>
					@php
						$phones = explode('-', $page->getMetaValue('phones'));
					@endphp
					@if(!empty($phones))
						<div class="flex items-center mb-8">
							<img class="w-[24px] h-[24px] object-contain me-3" src="{{ asset('assets/front/icons/tel.svg') }}" alt="تلفن">
							<span class="text-black opacity-60 me-3">شماره تماس جهت مشاوره</span>
							<div class="text-black opacity-80 text-base flex flex-wrap justify-center">
								@foreach($phones as $phone)
									<a class="hover:text-primary-950 md:flex-[0_0_100%] lg:flex-auto" href="tel:{{ $phone }}">
										{{ $phone }}
									</a>
									@if(!$loop->last)
										<span class="text-gray-500 whitespace-nowrap px-1 md:hidden lg:inline">-</span>
									@endif
								@endforeach
							</div>
						</div>
					@endif
					<div class="flex items-center mb-8">
						<img class="w-[24px] h-[24px] object-contain me-3" src="{{ asset('assets/front/icons/marker-pin.svg') }}" alt="آدرس">
						<span class="text-black opacity-60 me-3">آدرس کلینیک پردیس</span>
						<div class="text-black opacity-80 text-base">{{ $page->getMetaValue('address') }}</div>
					</div>
					<div class="grid grid-cols-2 gap-x-3 gap-y-6 text-[#00467A] w-full xl:w-[60%]">
						@foreach($page->socialNetworks as $socialNetwork)
							<div>
								<a href="{{ $socialNetwork->address_url }}" class="flex items-center font-bold py-3 rounded-md hover:bg-[#00457a1d] px-3 w-fit">
									<div class="w-6 h-6 me-2">
										@include('front.shared.icons.' . $socialNetwork->socialNetworkType->icon, ['fill' => '#00467A'])
									</div>
									<span>{{ $socialNetwork->socialNetworkType->name }}</span>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<hr class="border-gray-200 w-full mb-7">
			<h3 class="mb-8 font-bold text-xl">{{ $page->getMetaValue('form')['title'] }}</h3>
			<p class="text-base leading-7 mb-5">{{ $page->getMetaValue('form')['description'] }}</p>
			<form action="" class="mb-8" method="post">
				@csrf
				<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-5">
					<div class="form-item">
						<input name="name" id="name" class="placeholder:text-gray-300 w-full rounded-lg px-3 py-2" type="text" placeholder="@lang('front/contact_info.fields.name')">
					</div>
					<div class="form-item">
						<input name="email" id="email" class="placeholder:text-gray-300 w-full rounded-lg px-3 py-2" type="email" placeholder="@lang('front/contact_info.fields.email')">
					</div>
					<div class="form-item">
						<input name="subject" id="subject" class="placeholder:text-gray-300 w-full rounded-lg px-3 py-2" type="text" placeholder="@lang('front/contact_info.fields.subject')">
					</div>
				</div>
				<div class="form-item mb-5">
					<textarea class="placeholder:text-gray-300 w-full rounded-lg p-3" placeholder="@lang('front/contact_info.fields.content')" name="content" id="content" rows="7"></textarea>
				</div>

				<button type="submit" class="btn btn-primary px-9 py-2">ارسال</button>
			</form>
		</div>
	</main>
@endsection

@push('scripts')
	@vite('resources/js/pages/contact/index.js')
@endpush