<div>
	@include('front.layouts.footer.footer-title', ['title' => 'لینک های مرتبط'])
	@php
		$links = getSetting('footer_links', []);
	@endphp
	<ul class="columns-2">
		@if(!empty($links))
			@foreach($links['title'] as $linkKey => $linkTitle)
				<li class="mb-4">
					<a class="text-primary-950" href="{{ $links['url'][$linkKey] }}">{{ $linkTitle }}</a>
				</li>
			@endforeach
		@endif
	</ul>
</div>
