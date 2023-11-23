<section class="custom-container pt-12 pb-16">
	@include('front.shared.section-title', [
		'title' => __('front/faq.plural'),
	])
	<div class="grid grid-cols-1 md:grid-cols-2 gap-11">
		<div class="faq-list">
			@foreach($faqs as $faq)
				@include('front.shared.accordion.accordion-item', ['faq' => $faq])
			@endforeach
		</div>
		<div class="flex h-full items-start justify-center">
			<img src="{{ asset('assets/front/images/FAQ.png') }}" alt="@lang('front/faq.plural')">
		</div>
	</div>
</section>