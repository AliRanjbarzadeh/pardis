<div class="shadow-md bg-white rounded-md">
	<ul>
		@foreach($contacts as $contact)
			<li class="last:border-b-0 border-b border-gray-50">
				<a href="{{ $contact->link }}" class="hover:bg-slate-100 block py-3 px-4 text-gray-400">
					<p>{{ $contact->contact_value }}</p>
					<span class="text-primary-950 text-xs">{{ $contact->contact_title }}</span>
				</a>
			</li>
		@endforeach
	</ul>
</div>