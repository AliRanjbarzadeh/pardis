@extends('front.layouts.master')

@section('content')
	<main class="pt-14">
		<div class="custom-container">
			@include('front.shared.section-title', [
				'title' => __('front/insurance.plural'),
			])
			<section class="mb-3">
				<label for="insurance" class="block mb-3">@lang('front/insurance.sentences.choose')</label>
				<select id="insurance" class="select2 w-2/6" data-toggle="select2" name="state">
					@foreach($insurances as $insurance)
						<option value="{{ $insurance->id }}" @selected($loop->first)>{{ $insurance->name }}</option>
					@endforeach
				</select>
			</section>
			<section>
				@if($insurances->isNotEmpty())
					<h2 id="insuranceName" class="font-bold text-xl mb-7">{{ $insurances->first()->name }}</h2>
					<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-14">
						@foreach($categories as $category)
							<div class="bg-white rounded-xl shadow-md">
								<ul>
									<li class="border-b border-gray-100 last:border-b-0 px-4 py-4">
										<h4 class="font-bold text-lg">{{ $category->name }}</h4>
									</li>
									@foreach($category->categories as $child)
										<li class="border-b border-gray-100 last:border-b-0 px-4 py-3">
											<div class="flex items-center justify-between">
												<span class="text-gray-350">{{ $child->name }}</span>
												<span class="text-green-500 @if(!in_array($child->id, $insurances->first()->categories->pluck('id')->all())) hidden @endif" data-has="{{ $child->id }}">@lang('front/global.words.has')</span>
												<span class="text-red-500 @if(in_array($child->id, $insurances->first()->categories->pluck('id')->all())) hidden @endif" data-has-not="{{ $child->id }}">@lang('front/global.words.has_not')</span>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						@endforeach
					</div>
				@endif
			</section>
		</div>
	</main>
@endsection

@push('scripts')
	<script type="text/javascript">
		let insurances = @json($insurances);
	</script>
	@vite('resources/js/pages/insurances/index.js')
@endpush
