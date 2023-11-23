<div class="menu-sidebar" id="mobile-side-menu">
	<div class="flex w-72 flex-col item-menu">

		<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 py-4">
			<nav class="flex flex-1 flex-col">
				<ul id="menu-mobile" role="list" class="flex flex-1 flex-col gap-y-1 -mx-2 space-y-1">
					@foreach($menus as $menu)
						@include('front.layouts.header.menu-item', ['menu' => $menu])
					@endforeach
				</ul>
			</nav>
		</div>

	</div>
</div>