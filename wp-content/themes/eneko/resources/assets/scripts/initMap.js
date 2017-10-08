export default function initMap() {
	const $list = $('.permanence');
	window.maps = [];
	$list.each(function (i, el) {
		let {lat, lng} = el.dataset;
		lat = parseFloat(lat);
		lng = parseFloat(lng);
		const position = {lat, lng};
		if (lat && lng) {
			const map = new google.maps.Map(el.querySelector('.modal__map'), {
				zoom: 15,
				scrollwheel: true,
				center: position,
				disableDefaultUI: true,
				styles: [
					{elementType: 'geometry', stylers: [{color: '#f5f5f5'}]},
					{elementType: 'labels.text.stroke', stylers: [{color: '#f5f5f5'}]},
					{elementType: 'labels.text.fill', stylers: [{color: '#616161'}]},
					{
						featureType: 'administrative.locality',
						elementType: 'labels.text.fill',
						stylers: [{visibility: "off"}]
					},
					{
						featureType: 'poi',
						elementType: 'labels.text.fill',
						stylers: [{visibility: "off"}]
					},
					{
						featureType: 'poi.park',
						elementType: 'geometry',
						stylers: [{visibility: "off"}]
					},
					{
						featureType: 'poi.park',
						elementType: 'labels.text.fill',
						stylers: [{visibility: "off"}]
					},
					{
						featureType: 'road',
						elementType: 'geometry',
						stylers: [{color: '#ffffff'}]
					},
					{
						featureType: 'road',
						elementType: 'geometry.stroke',
						stylers: [{color: '#140c0d'}]
					},
					{
						featureType: 'road',
						elementType: 'labels.text.fill',
						stylers: [{color: '#757575'}]
					},
					{
						featureType: 'road.highway',
						elementType: 'geometry',
						stylers: [{color: '#dadada'}]
					},
					{
						featureType: 'road.highway',
						elementType: 'geometry.stroke',
						stylers: [{color: '#eee'}]
					},
					{
						featureType: 'road.highway',
						elementType: 'labels.text.fill',
						stylers: [{color: '#616161'}]
					},
					{
						featureType: 'transit',
						elementType: 'geometry',
						stylers: [{color: '#eee'}]
					},
					{
						featureType: 'transit.station',
						elementType: 'labels.text.fill',
						stylers: [{visibility: "off"}]
					},
					{
						featureType: 'water',
						elementType: 'geometry',
						stylers: [{color: '#c9c9c9'}]
					},
					{
						featureType: 'water',
						elementType: 'labels.text.fill',
						stylers: [{visibility: "off"}]
					},
					{
						featureType: 'water',
						elementType: 'labels.text.stroke',
						stylers: [{color: '#9e9e9e'}]
					}
				]

			});
			const marker = new google.maps.Marker({
				position: position,
				map: map
			});
			maps.push({id: i, map});
			el.setAttribute('data-id', i);
		}
	})
}