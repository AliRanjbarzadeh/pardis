<li class="last:border-b-0 border-b border-gray-50">
	<a href="{{ route('blogs.category', $category->seo->link) }}" class="py-3 px-4 flex items-center justify-between text-gray-400">
		<div class="flex items-center">
			<span class="bg-gray-400 rounded-full w-2 h-2 me-2"></span>
			<span>{{ $category->name }}</span>
		</div>
		<span>@lang('front/category.words.blog.count', ['count' => $category->blogs_count])</span>
	</a>
</li>