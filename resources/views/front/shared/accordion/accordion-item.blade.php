<div class="accordion-item rounded-lg border border-gray-200 overflow-hidden mb-4">
	<div class="accordion-info flex flex-row justify-between items-center p-4 cursor-pointer hover:bg-gray-100 bg-white">
		<div class="title lg:line-clamp-1 line-clamp-2 flex-1 flex-grow font-semibold text-gray-600 lg:text-base text-sm">
			{{ $faq->question }}
		</div>
		<div class="icon  transition-all duration-150">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 border-gray-400">
				<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
			</svg>
		</div>
	</div>
	<div class="accordion-content overflow-hidden h-0 bg-white transition-all duration-300  leading-8">
		<div class="html-content p-4">
			<p>{{ $faq->answer }}</p>
		</div>
	</div>
</div>