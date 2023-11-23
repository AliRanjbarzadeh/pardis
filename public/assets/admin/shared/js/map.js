let mapSearchResult, mapSearchInput, map, mapLocationInput;
window.addEventListener('DOMContentLoaded', function () {
	map = new L.Map("map", {
		key: "web.868cea50bfdc4a1c870316ab45f78863",
		maptype: "osm-bright",
		poi: false,
		traffic: false,
		center: [29.606684, 52.483806],
		zoom: 17,
	});

	map.on('click', function (e) {
		addMarker(map, [e.latlng.lat, e.latlng.lng], {draggable: true});
	});

	mapSearchInput = document.getElementById('map-search');
	mapSearchResult = document.getElementById('map-search-result');
	mapLocationInput = document.getElementById('map-location');

	if (mapLocationInput.value !== '') {
		addMarker(map, JSON.parse(mapLocationInput.value), {draggable: true})
	} else {
		addMarker(map, [29.606684, 52.483806], {draggable: true})
	}

	let mTimeout = null;

	mapSearchInput.addEventListener('input', function () {
		if (mTimeout !== null) {
			clearTimeout(mTimeout);
		}

		let term = this.value;
		const lat = 29.584593;
		const lng = 52.614191;

		//remove rounded classes from input
		mapSearchInput.classList.remove("rounded-0", "rounded-top");

		//hide search result
		mapSearchResult.classList.add('d-none');
		mapSearchResult.innerHTML = '';

		mTimeout = setTimeout(() => {
			if (term !== undefined && term !== null && term !== '') {
				delete axios.defaults.headers.common["X-CSRF-TOKEN"];

				axios.get(`https://api.neshan.org/v1/search?term=${term}&lat=${lat}&lng=${lng}`, {
					'headers': {
						'Api-Key': "service.e23add5b3f964bd0ab5fa9fca0daea70"
					}
				}).then(response => {
					if (response.data.count > 0) {
						mapSearchInput.classList.add("rounded-0", "rounded-top");
						mapSearchResult.classList.remove('d-none');

						addMapItems(response.data.items)
					}
				}).catch(error => {
					console.error(error);
				});
			}
		}, 500);

	});
});

function addMapItems(items) {
	for (const item of items) {
		let listItem = mCreateElement({
			element: 'a',
			text: `${item.title}، ${item.region}`,
			attributes: [
				{name: 'class', value: 'list-group-item list-group-item-action'},
				{name: 'href', value: 'javascript:void(0);'},
				{name: 'onclick', value: 'clickItemResult(this)'},
				{name: 'data-location', value: JSON.stringify([item.location.y, item.location.x])},
			]
		});
		mapSearchResult.appendChild(listItem);
	}
}

function clickItemResult(element) {
	let location = JSON.parse(element.getAttribute('data-location'));

	//remove rounded classes from input
	mapSearchInput.value = null;
	mapSearchInput.classList.remove("rounded-0", "rounded-top");

	//hide search result
	mapSearchResult.classList.add('d-none');
	mapSearchResult.innerHTML = '';

	addMarker(map, location, {draggable: true})
}

function addMarker(mMap, mLocation, mOptions) {
	map.eachLayer(function (layer) {
		if (layer instanceof L.Marker) {
			map.removeLayer(layer);
		}
	});

	const mMarker = L.marker(mLocation, mOptions).addTo(mMap)
		.bindPopup('برای جابجایی کلیک را نگه داشته و مارکر را جابجا کنید')
		.openPopup()
		.on('dragend', function (e) {
			mMarker.openPopup();
			mapLocationInput.value = JSON.stringify([e.target._latlng.lat, e.target._latlng.lng]);
		});
	mMap.panTo(mLocation);

	mapLocationInput.value = JSON.stringify(mLocation);
}