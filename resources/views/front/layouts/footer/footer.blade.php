<div class="bg-primary-100 pt-10 relative overflow-hidden">
	<img class="absolute inset-x-0 bottom-0 z-0 w-full h-full object-cover object-bottom" src="{{ asset('assets/front/images/footer-bg.png') }}" alt="Footer Background">
	<div class="custom-container relative z-10">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
			@include('front.layouts.footer.footer-about')
			@include('front.layouts.footer.footer-links')
			@include('front.layouts.footer.footer-contact')
		</div>
		@include('front.shared.divider')
		<div class="flex justify-between py-7">
			<span>@lang('front/global.sentences.copy_right')</span>
			<span>@lang('front/global.sentences.developer')</span>
		</div>
	</div>
</div>