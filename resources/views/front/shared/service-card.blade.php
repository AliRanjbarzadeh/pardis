<a href="{{ route('services.show', $service->seo->link) }}" class="flex flex-col items-center group {{ $class ?? '' }}">
	<div class="p-4 md:p-8 rounded-[10px] shadow-[0px_1px_10px_0px_#0000000D] bg-white flex items-center justify-center group-hover:bg-primary-950 transition-colors mb-3 h-[90px] w-[90px] md:w-[130px] md:h-[130px]">
		<img class="group-hover:filter group-hover:brightness-0 group-hover:invert" src="{{ $service->getMediumByName('iconImage')?->url }}" alt="{{ $service->title }}">
	</div>
	<span class="font-bold text-primary-950 text-center">
	{{ $service->title }}
	</span>
</a>