<aside class="md:col-span-2 lg:col-span-1 col-span-5">
	<section class="hidden md:block">
		@include('front.shared.search-section', ['placeholder' => __('front/doctor.words.search')])
	</section>
	<section class="hidden md:block">
		@include('front.shared.section-title', [
			'title' => __('front/doctor.words.filter'),
			'class' => 'md:pt-12',
			'fontSize' => 'text-lg',
		])
		<div class="shadow-md bg-white rounded-md">
			<div>
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
			</div>
		</div>
	</section>
</aside>