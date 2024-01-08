@unless($breadcrumbs->isEmpty())
	<div class="breadcrumb bg-[#FDF2FF] text-[#949494]">
		<div class="custom-container py-3">
			<ul class="flex items-center overflow-x-auto overflow-y-hidden">
				@foreach ($breadcrumbs as $breadcrumb)
					@if(!is_null($breadcrumb->url) && !$loop->last)
						<li>
							<a href="{{ $breadcrumb->url }}" class="hover:text-primary-950 whitespace-nowrap">{!! $breadcrumb->title !!}</a>
						</li>
						<span class="material-symbols-outlined px-1 ltr:rotate-180">chevron_left</span>
					@elseif(!$loop->last)
						<li>
							<span class="hover:text-primary-950 whitespace-nowrap">{!! $breadcrumb->title !!}</span>
						</li>
						<span class="material-symbols-outlined px-1 ltr:rotate-180">chevron_left</span>
					@else
						<li>
							<span class="hover:text-primary-950 whitespace-nowrap">{!! $breadcrumb->title !!}</span>
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>
@endunless