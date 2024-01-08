@extends('front.layouts.master')

@section('content')
	<main class="pb-14">
		<div class="top-banner">
			<div class="custom-container">
				<div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-20 items-end">
					<div class="py-3 lg:pt-20 md:pb-16">
						<div class="shadow-md rounded-[20px] bg-white">
							<section class="px-5 pt-5">
								<div class="flex items-center lg:items-start mb-4">
									<div class="rounded-[100%] me-5 overflow-hidden lg:hidden bg-secondary-950 w-28 h-28 flex-[0_0_7rem]">
										<img class="h-full w-full object-contain object-bottom" src="{{ $doctor->feature_image->url }}" alt="{{ $doctor->full_name }}">
									</div>
									<div>
										<h1 class="text-xl font-bold mt-2 mb-2">{{ $doctor->full_name }}</h1>
										<div class="flex items-center mb-3 flex-wrap">
											<span class="bg-secondary-950 text-white px-3 py-1 me-3 rounded-md mb-2 sm:mb-0">{{ $doctor->specialities->first()->name }}</span>
											<div class="flex items-center">
												<span class="text-gray-350 me-1">@lang('front/doctor.words.medical_number')</span>
												<span class="text-secondary-950">{{ $doctor->medical_number }}</span>
											</div>
										</div>
									</div>
								</div>
								<p class="text-justify leading-7">{{ $doctor->description }}</p>
								@if(!empty($doctor->work_hours))
									<div class="pt-4">
										<p class="font-bold text-primary-950 text-base mb-2">@lang('front/doctor.words.work_hours')</p>
										<ul>
											@foreach($doctor->work_hours as $workHour)
												<li class="last:mb-0 mb-3">
													<div class="flex justify-between items-center">
														<span class="font-bold">{{ $workHour['title'] }}</span>
														<div class="flex items-center">
															@if(isset($workHour['first']))
																<span class="text-primary-950">@lang('front/work_hour.sentences.shift_text', ['from' => $workHour['first']['from'], 'to' => $workHour['first']['to']])</span>
															@endif

															@if(isset($workHour['second']))
																<span class="h-[2px] w-[8px] bg-gray-100 mx-1 block"></span>
																<span class="text-primary-950">@lang('front/work_hour.sentences.shift_text', ['from' => $workHour['second']['from'], 'to' => $workHour['second']['to']])</span>
															@endif
														</div>
													</div>
												</li>
											@endforeach
										</ul>
									</div>
								@endif
							</section>
							@if($doctor->socialNetworks->isNotEmpty())
								<hr class="border-gray-200 w-full mt-3">
								<div class="flex items-center justify-between px-5 py-4">
									<span class="font-bold text-primary-950">@lang('front/social_network.plural')</span>
									<div class="flex items-center gap-2">
										@foreach($doctor->socialNetworks as $socialNetwork)
											<a class="w-9 h-9 hover:text-secondary-950" href="{{ $socialNetwork->address_url }}">
												<img src="{{ asset("assets/front/icons/{$socialNetwork->socialNetworkType->icon}.svg") }}" alt="">
											</a>
										@endforeach
									</div>
								</div>
							@endif

							@if($doctor->contacts->isNotEmpty())
								<hr class="border-gray-200 w-full">
								<div class="flex items-center justify-between px-5 py-4">
									<span class="font-bold text-primary-950">@lang('front/contact_info.words.phone')</span>
									<div class="text-base font-bold">
										@foreach($doctor->contacts as $contact)
											<a href="{{ $contact->link }}" class="hover:text-secondary-950">
												{{ $contact->contact_value }}
											</a>
											@if(!$loop->last)
												&nbsp;@lang('front/global.words.and')&nbsp;
											@endif
										@endforeach
									</div>
								</div>
							@endif

							<div class="p-5">
								<a class="btn btn-primary py-3 w-full text-base font-bold shadow-btn1" href="{{ $doctor->reservation_link }}">
									@lang('front/doctor.sentences.reserve', ['name' => $doctor->full_name])
								</a>
							</div>
						</div>
					</div>
					<div class="h-full w-fit hidden lg:block max-h-[70vh] pt-8">
						<img class="h-full w-full object-contain object-bottom" src="{{ $doctor->feature_image->url }}" alt>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="bg-white sticky top-[65px] z-50 sticky-menu hidden md:block">
				<div class="custom-container">
					<ul class="flex font-bold justify-between lg:justify-start">
						<li>
							<a class="menu-item text-center px-8 py-4 active" href="#section1">
								@lang('front/doctor.words.biography')
							</a>
						</li>

						@if(!empty($doctor->resumes))
							<li>
								<a class="menu-item text-center lg:px-8 py-4" href="#section2">
									@lang('front/doctor.words.resumes')
								</a>
							</li>
						@endif

						@if($doctor->clinics->isNotEmpty())
							<li>
								<a class="menu-item text-center lg:px-8 py-4" href="#section3">
									@lang('front/doctor.words.clinics')
								</a>
							</li>
						@endif

						@if($doctor->getMediaByNames('gallery')->isNotEmpty())
							<li>
								<a class="menu-item text-center lg:px-8 py-4" href="#section4">
									@lang('front/doctor.words.galleries')
								</a>
							</li>
						@endif

						@if($doctor->insurances->isNotEmpty())
							<li>
								<a class="menu-item text-center lg:px-8 py-4" href="#section5">
									@lang('front/doctor.words.insurances')
								</a>
							</li>
						@endif

						@if($doctor->blogs->isNotEmpty())
							<li>
								<a class="menu-item text-center lg:px-8 py-4" href="#section6">
									@lang('front/doctor.words.blogs')
								</a>
							</li>
						@endif

						<li>
							<a class="menu-item text-center lg:px-8 py-4" href="#section7">
								@lang('front/doctor.words.comments')
							</a>
						</li>
					</ul>
				</div>
			</div>

			<section id="section1" class="section custom-container mb-10 pt-12">
				@include('front.shared.section-title', [
					'title' => __('front/doctor.sentences.biography', ['name' => $doctor->full_name]),
				])
				<p class="leading-8 text-justify text-base">{!! $doctor->full_description !!}</p>
			</section>

			@if(!is_null($doctor->resumes))
				<section id="section2" class="section">
					<div class="bg-white">
						<div class="custom-container pt-12 pb-8">
							@include('front.shared.section-title', [
								'title' => __('front/doctor.sentences.resumes', ['name' => $doctor->full_name]),
								'class' => 'mb-4'
							])
							<ul class="text-base">
								@foreach($doctor->resumes as $resume)
									<li class="flex items-center mb-2">
										<span class="material-symbols-outlined text-primary-950 me-4 text-2xl">done</span>
										<span>{{ $resume['title'] }}</span>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</section>
			@endif

			@if($doctor->clinics->isNotEmpty())
				<section id="section3" class="section pt-12">
					@include('front.contents.doctors.clinics-section', ['clinics' => $doctor->clinics])
				</section>
			@endif

			@if($doctor->getMediaByNames('gallery')->isNotEmpty())
				<section id="section4" class="section bg-white">
					<div class="custom-container">
						@include('front.shared.photo-gallery.photo-gallery', ['media' => $doctor->getMediaByNames('gallery')])
					</div>
				</section>
			@endif

			@if($doctor->insurances->isNotEmpty())
				<section id="section5" class="section custom-container">
					@include('front.shared.insurances.insurances-section', ['insurances' => $doctor->insurances])
				</section>
			@endif

			@if($doctor->blogs->isNotEmpty())
				<section id="section6" class="section bg-white">
					<div class="custom-container">
						@include('front.contents.home.blogs.blog-latest-section', ['blogs' => $doctor->blogs])
					</div>
				</section>
			@endif

			<section id="section7" class="section custom-container">
				@include('front.shared.comments-section', ['comments' => $doctor->comments, 'count' => $doctor->comments_count, 'class' => 'pt-12'])
				@include('front.shared.comment-form-section', ['action' => route('comments.store', $doctor->id), 'modelType' => get_class($doctor)])
			</section>
		</div>
	</main>
@endsection

@push('styles')
	@vite('resources/css/pages/doctor/doctor-details.scss')
@endpush

@push('scripts')
	@vite('resources/js/pages/doctors/detail.js')
@endpush