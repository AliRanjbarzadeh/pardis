<div>
	@include('front.layouts.footer.footer-title', ['title' => 'ما را در شبکه های اجتماعی دنبال کنید'])
	<div class="flex gap-2">
		@foreach($contactInfo->socialNetworks as $socialNetwork)
			<a class="w-9 h-9" href="{{ $socialNetwork->address_url }}">
				<img src="{{ asset('assets/front/icons/'.$socialNetwork->socialNetworkType->icon.'.svg') }}" alt="{{ $socialNetwork->title }}">
			</a>
		@endforeach
	</div>
	@include('front.shared.divider', ['class' => 'my-5'])
	@include('front.layouts.footer.footer-title', ['title' => 'اطلاعات تماس'])
	<div class="flex items-center mb-5">
		<span class="material-symbols-outlined me-2">apartment</span>
		<strong class="me-2 whitespace-nowrap">آدرس : </strong>
		<span>{{ $contactInfo->getMetaValue('address') }}</span>
	</div>
	<div class="flex mb-5">
		<span class="material-symbols-outlined me-2">call</span>
		<strong class="me-2 whitespace-nowrap">شماره تماس :</strong>
		@php
			$phones = explode('-', $contactInfo->getMetaValue('phones'));
		@endphp
		@if(!empty($phones))
			<a class="hover:underline" href="tel:{{ $phones[0] }}">{{ $phones[0] }}</a>
		@endif
	</div>
</div>
