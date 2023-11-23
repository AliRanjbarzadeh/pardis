@if ($paginator->hasPages())
	<ul class="flex items-center font-bold {{ $class ?? '' }}">
		<li class="w-8 h-8">
			@if ($paginator->onFirstPage())
				<span class="w-full h-full rounded-full flex items-center justify-center hover:bg-primary-200">
				<span class="material-symbols-outlined">chevron_right</span>
			</span>
			@else
				<a href="{{ $paginator->previousPageUrl() }}" class="w-full h-full rounded-full flex items-center justify-center hover:bg-primary-200">
					<span class="material-symbols-outlined">chevron_right</span>
				</a>
			@endif
		</li>

		@foreach ($elements as $element)
			@if (is_string($element))
				<li class="disabled w-8 h-8" aria-disabled="true">
					<span>{{ $element }}</span>
				</li>
			@endif

			@if (is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<li class="w-8 h-8" aria-current="page">
							<span class="w-full h-full rounded-full flex items-center justify-center bg-primary-950 text-white">{{ $page }}</span>
						</li>
					@else
						<li class="w-8 h-8">
							<a href="{{ $url }}" class="w-full h-full rounded-full flex items-center justify-center hover:bg-primary-200">
								{{ $page }}
							</a>
						</li>
					@endif
				@endforeach
			@endif
		@endforeach

		<li class="w-8 h-8">
			@if ($paginator->hasMorePages())
				<a href="{{ $paginator->nextPageUrl() }}" class="w-full h-full rounded-full flex items-center justify-center hover:bg-primary-200">
					<span class="material-symbols-outlined">chevron_left</span>
				</a>
			@else
				<span class="w-full h-full rounded-full flex items-center justify-center hover:bg-primary-200">
				<span class="material-symbols-outlined">chevron_left</span>
			</span>
			@endif
		</li>
	</ul>
@else
	<span class="flex items-center font-bold {{ $class ?? '' }}"></span>
@endif
