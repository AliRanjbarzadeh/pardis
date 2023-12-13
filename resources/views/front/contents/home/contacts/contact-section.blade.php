<section class="custom-container pt-14 pb-9">
	@include('front.shared.section-title', [
		'title' => __('front/communication.plural'),
		'url' => 'https://neshan.org/maps/@29.606684,52.484348,17.7z,0p/routing/car/destination/29.606684,52.483806/poi_hash/2fc3c7dabe839cff83f266208cbf92a9',
		'buttonText' => 'مسیریابی با نشان',
	])
	<div class="grid grid-cols-1 md:grid-cols-2 gap-11">
		<div class="address-list">
			@foreach($communications as $communication)
				<div class="accordion-item rounded-lg border border-gray-200 overflow-hidden mb-4">
					<div class="accordion-info flex flex-row justify-between items-center p-4 cursor-pointer hover:bg-gray-100 bg-white">
						<div class="title lg:line-clamp-1 line-clamp-2 flex-1 flex-grow font-semibold text-gray-600 lg:text-base text-sm">{{ $communication->title }}</div>
						<div class="icon  transition-all duration-150">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 border-gray-400">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
							</svg>
						</div>
					</div>
					<div class="accordion-content overflow-hidden h-0 bg-white transition-all duration-300  leading-8">
						<div class="tabs-content p-4 pt-0">
							<div class="tabs">
								<ul class="flex mt-1">
									@foreach($communication->routes as $route)
										<li class="@if(!$loop->first) ms-3 @endif">
											<a data-tab="tab{{ $loop->iteration }}" class="block tab-link px-5 py-[2px] rounded-lg cursor-pointer bg-gray-100 @if($loop->first) !bg-primary-950 text-white @endif">
												@lang('front/communication.words.path.singular') {{ __('front/communication.words.path.numbers.' . $loop->iteration) }}
											</a>
										</li>
									@endforeach
								</ul>
								@foreach($communication->routes as $route)
									<div class="tab-content @if(!$loop->first) hidden @endif" data-tab="tab{{$loop->iteration}}">
										<p class=" mt-2">
											@foreach($route['lines'] as $line)
												{{ "$loop->iteration - $line" }}
												@if(!$loop->last)
													<br>
												@endif
											@endforeach
										</p>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<div id="map"></div>
		<span id="map-location" class="hidden">{{ $contactInfo?->getMetaValue('location', true) }}</span>
	</div>
</section>
