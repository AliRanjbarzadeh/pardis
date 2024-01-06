@if(!is_null($popup))
	<span id="isBanner" class="hidden">{{ $popup->is_banner }}</span>
	@switch($popup->type->value)
		@case('text')
			<section id="popup" class="modal p-5 fixed top-1/4 z-[999999999] w-11/12 md:w-[55vw] xl:w-[40vw] inset-x-0 mx-auto bg-white rounded-lg">
				<h1 class="text-primary-950 font-bold text-[22px] mb-5">{{ $popup->title }}</h1>
				<div class="modal-content leading-8 max-h-[30vh] overflow-y-auto">{{ $popup->description }}</div>
				<hr class="border-gray-200 w-full my-3">
				<button type="button" class="close-modal btn btn-secondary px-10 py-2 shadow-btn2 !rounded-full">
					بستن پنجره
				</button>
			</section>
			@break;

		@case('image')
			<section id="banner-popup" class="modal banner-modal fixed top-1/4 z-[999999999] w-11/12 md:w-[55vw] xl:w-[40vw] inset-x-0 mx-auto rounded-lg overflow-hidden aspect-video">
				<a href="{{ $popup->url }}">
					<img src="{{ $popup->feature_image->url }}" class="w-full h-full object-cover object-center" alt="{{ $popup->title }}">
				</a>
				<button type="button" class="close-banner-modal btn bg-black bg-opacity-20 hover:bg-opacity-60 text-white absolute right-3 bottom-3 px-6 py-2 !rounded-full">
					بستن پنجره
				</button>
			</section>
			@break;
	@endswitch
	<div id="popup-overlay" class="overlay fixed inset-0 w-full h-full z-[99999999] bg-black bg-opacity-50"></div>
@endif
