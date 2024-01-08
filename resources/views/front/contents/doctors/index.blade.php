@extends('front.layouts.master')

@section('content')
	<main class="custom-container pt-14 pb-10">
		<section class="md:hidden block">
			@include('front.shared.search-section', ['placeholder' => __('front/doctor.words.search')])

			@include('front.shared.section-title', [
				'title' => $page->title,
				'class' => 'mb-5 mt-8',
				'fontSize' => 'text-lg',
				'description' => $page->description,
			])
			<div class="shadow-md bg-white py-3 px-4 rounded-md flex items-center justify-between relative">
				<div class="flex items-center">
					<span class="material-symbols-outlined me-2">filter_list</span>
					<span>فیلتر</span>
				</div>
				<div >
					<div class="flex items-center cursor-pointer text-primary-950 select-none" id="toggle-filters-popover">
						<span id="filters-result">{{ request('speciality')?->name ?? __('front/global.words.filter.all') }}</span>
						<span class="material-symbols-outlined ms-1">arrow_drop_down</span>
					</div>
					<div class="shadow-md bg-white rounded-md absolute left-0 top-full w-[50%] invisible opacity-0 -translate-y-2  transition-all z-[9999999]" id="filters-popover">
						<form>
							<ul>
								<li class="last:border-b-0 border-b border-gray-50 py-3 px-4 text-gray-400">
									@include('front.shared.radio-button', [
										'title' => __('front/global.words.all'),
										'name' => 'category',
										'id' => "all",
										'value' => 'all',
										'checked' => empty(request('speciality'))
									])
								</li>
								@foreach($specialities as $speciality)
									<li class="last:border-b-0 border-b border-gray-50 py-3 px-4 text-gray-400">
										@include('front.shared.radio-button', [
											'title' => $speciality->name,
											'name' => 'category',
											'id' => $speciality->id,
											'value' => $speciality->seo->link,
											'checked' => request('speciality')?->id == $speciality->id
										])
									</li>
								@endforeach
							</ul>
						</form>
					</div>
				</div>
			</div>
		</section>
		@include('front.shared.section-title', [
			'title' => $page->title,
			'class' => 'hidden md:block',
			'description' => $page->description,
		])
		<div class="grid grid-cols-5 lg:grid-cols-4 gap-4 mt-7">
			@include('front.contents.doctors.sidebar', ['specialities' => $specialities])

			<section class="md:col-span-3 col-span-5">
				<div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
					@foreach($doctors as $doctor)
						@include('front.shared.doctor-card', ['doctor' => $doctor])
					@endforeach
				</div>
				{{ $doctors->links(null, ['class' => 'mt-9 mb-8']) }}
			</section>
		</div>
		@include('front.shared.limited-paragraph', ['description' => $page->full_description])
	</main>
@endsection

@push('scripts')
	@vite('resources/js/pages/doctors/index.js')
@endpush