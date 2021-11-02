const { default: axios } = require('axios');

require('./bootstrap');

require('alpinejs');

if (document.querySelector('#map')) {
    let addressinput = document.querySelector('input[name=address]');
    let postalinput = document.querySelector('input[name=postalcode]');
    let cityinput = document.querySelector('input[name=city]');
    let regioninput = document.querySelector('input[name=region]');
    let countryselect = document.querySelector('select[name=country]');
    let coordsinput = document.querySelector('input[name=location]');
    
    addressinput.onblur = (e) => {
        handleGeoCoding();
    };

    postalinput.onblur = (e) => {
        handleGeoCoding();
    };

    cityinput.onblur = (e) => {
        handleGeoCoding();
    };

    regioninput.onblur = (e) => {
        handleGeoCoding();
    };

    countryselect.onchange = (e) => {
        handleGeoCoding();
    };

    const handleGeoCoding = () => {
        let address = addressinput.value;
        let postalcode = postalinput.value;
        let city = cityinput.value;
        let region = regioninput.value;
        let country = countryselect.value;

        if (address != '' && city != '' && country != '') {
            axios.get(`/api/geocoding/${country}, ${region}, ${city}, ${address}, ${postalcode}`).then(response => {
                if (response.data.features.length > 0) {
                    showOnMap([response.data.features[0].center[1], response.data.features[0].center[0]], true);
                }
            });
        }
    };

    let map = window.leaflet.map('map').setView([51.505, -0.09], 2);

    window.leaflet.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicnZyYmsxOTgwIiwiYSI6ImNrdmYxemNuZTB2N2Eybm4zbW5rb2JuamkifQ.hk2yCTzPCf_m0NozWXwDag'
    }).addTo(map);

    const showOnMap = (coords, show_marker) => {
        map.setView(coords, 15);
        
        if (show_marker) {
            if (typeof marker !== 'undefined') {
                marker.remove();
            }

            marker = window.leaflet.marker(coords).addTo(map);

            if (coordsinput) {
                coordsinput.value = coords[0] + ', ' + coords[1];
            }
        }
    }

    let input = document.querySelector('input[name=location]');

    if (input && input.value !== '') {
        let coords = input.value.split(',');
        
        showOnMap([parseFloat(coords[0]), parseFloat(coords[1])], true);
    }

    if (window.navigator.geolocation) {
        window.navigator.geolocation.getCurrentPosition(function(response) {
            let input = document.querySelector('input[name=location]');

            if (!input || input.value === '') {
                showOnMap([response.coords.latitude, response.coords.longitude], false);
            }
        });
    }

    map.on('click', function(e) {
        showOnMap([e.latlng.lat, e.latlng.lng], true);
    });
}