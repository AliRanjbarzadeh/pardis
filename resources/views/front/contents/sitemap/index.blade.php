<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc>{{ url('') }}</loc>
		<priority>1.0</priority>
	</url>
	@foreach($data as $value)
		<url>
			@if(isset($value['loc']))
				<loc>{{ $value['loc'] }}</loc>
			@endif
			@if(isset($value['image']))
				<image:image>
					<image:loc>{{ $value['image']['loc'] }}</image:loc>
					@if(isset($value['image']['caption']))
						<image:caption>{{ $value['image']['caption'] }}</image:caption>
					@endif
				</image:image>
			@endif
			@if(isset($value['lastmod']))
				<lastmod>{{ $value['lastmod'] }}</lastmod>
			@endif
			@if(isset($value['changefreq']))
				<changefreq>{{ $value['changefreq'] }}</changefreq>
			@endif
			@if(isset($value['priority']))
				<priority>{{ $value['priority'] }}</priority>
			@endif
		</url>
	@endforeach
</urlset>
