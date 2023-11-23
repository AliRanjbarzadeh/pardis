<div class="flex justify-between items-center pb-7 {{ $class ?? '' }}">
	<strong class="text-gray-350 text-xl">@lang('front/comment.words.user')</strong>
	<span class="text-primary-950">@lang('front/blog.words.comments_count', ['count' => $count])</span>
</div>
@if($comments->isNotEmpty())
	<div class="comment-list">
		@foreach($comments as $comment)
			@include('front.shared.comment-item', ['comment' => $comment])
		@endforeach
	</div>
@endif
