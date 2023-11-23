@unless($breadcrumbs->isEmpty())
	<script type="application/ld+json">
		{
			"@context": "https://schema.org/",
			"@type": "BreadcrumbList",
			"itemListElement": [
				@foreach($breadcrumbs as $breadcrumb)
					{
						 "@type": "ListItem",
						 "position": {{ $loop->iteration }},
						 "name": "{{ $breadcrumb->title }}",
						 "item": "{{ $breadcrumb->url }}"
					}{{ $loop->last ? '' : ',' }}
				@endforeach
			]
	}
	</script>
@endunless