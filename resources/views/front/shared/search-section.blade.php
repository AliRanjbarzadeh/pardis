<form class="shadow-md bg-white py-1 ps-4 pe-2 rounded-full flex mb-4" method="get" action="{{ $action ?? '' }}">
	<div class="flex-grow relative">
		<input type="text" class="w-full outline-none placeholder:text-gray-200 absolute h-full inset-0" placeholder="{{ $placeholder ?? '' }}" name="search" value="{{ request('search') }}">
	</div>
	<button type="submit" class="flex justify-center items-center p-1 hover:text-primary-950">
		<span class="material-symbols-outlined">search</span>
	</button>
</form>