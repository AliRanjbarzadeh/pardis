window.addEventListener('DOMContentLoaded', function () {
	let locationElement = document.getElementById('map-location');
	let currentLocation = null;
	if (locationElement !== undefined && locationElement !== null) {
		if (locationElement.innerText !== '') {
			currentLocation = JSON.parse(locationElement.innerText);
		}
	}

	const map = new L.Map("map", {
		key: "web.868cea50bfdc4a1c870316ab45f78863",
		maptype: "osm-bright",
		poi: false,
		traffic: false,
		zoom: 17,
	});

	if (currentLocation === null) {
		currentLocation = [29.606684, 52.483806];
	}
	const marker = new L.Marker(currentLocation);
	marker.addTo(map)
		.bindPopup(__('front/global.words.app.name'));

	setTimeout(() => {
		map.panTo(currentLocation);
		marker.openPopup()
	}, 500);
});