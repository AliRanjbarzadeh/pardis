<div class="relative limit-paragraph">
	<div class="text-overflow block overflow-hidden break-words leading-7">
		{!! $description !!}
	</div>
	<div class="absolute transition-all mt-2 bottom-0 w-full h-full bg-gradient-to-t from-gray-50 to-transparent flex flex-col justify-end">
		<button class="btn-overflow px-7 py-2 btn btn-secondary shadow-md !rounded-full mx-auto less">@lang('front/global.words.read_more')</button>
	</div>
</div>
@push('scripts')
	@vite('resources/js/shared/limited-paragraph.js')
@endpush