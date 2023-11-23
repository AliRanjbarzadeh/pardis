<div class="flex flex-wrap">
	<span class="me-1">@lang('front/tag.plural') :</span>
	@foreach($tags as $tag)
		<span class="after:last:hidden text-teal-500 after:content-['،'] @if($loop->last) last:m-0 me-1 @endif">{{ $tag->name }}</span>
		@if(!$loop->last)
			&nbsp;
		@endif
	@endforeach
</div>