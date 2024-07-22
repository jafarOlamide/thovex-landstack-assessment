<template>
    <div id="map" style="height: 100vh;"></div>
</template>

<script>
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import { Loader } from "@googlemaps/js-api-loader"

    export default {
    setup() {
        const map = ref(null);

        //Default Map Loading Using Google Maps JS API Loader Library
        const loadMap = async () => {
            const loader = new Loader({
                apiKey: import.meta.env.VITE_GOOGLE_MAP_API_KEY,
                version: 'weekly',
            });

            loader.load().then(() => {
                initializeMap();
                getMarkedPoints();
            });
        };

        const initializeMap = () => {
            map.value = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 51.70003656498333, lng: -1.863078661866867 }, //LandStack Coordinates
                zoom: 10,
            });

        map.value.addListener('click', (e) => {
            storeMarkerPoints(e.latLng)
        });
        };

        const addPointMarker = (position) => {
            new google.maps.Marker({
                position: position,
                map: map.value,
            });
        };
        
        const storeMarkerPoints = (position) => {
            //Update UI To Add Point Marker
            addPointMarker(position);
            
            //Save Point To DB
            try {
                axios.post('/api/points', {
                    latitude: position.lat(),
                    longitude: position.lng(),
                });
            } catch (error) {
                console.log(error);
                alertError("Error storing points, see console for complete log!")
            }
            
        };
        
        const getMarkedPoints = async () => {
            try {
                //Retrieve saved points from api
                const savedPoints = await axios.get('/api/points');
                
                savedPoints.data.points.map((point) => {
                    const position = { lat: parseFloat(point.latitude), lng: parseFloat(point.longitude) };
                    addPointMarker(position);
                });
            } catch (error) {
                console.log(error);
                alertError("Error retrieving points, see console for complete log!")
            }
        };

        //Default JS Alert for Simple Error Handling
        const alertError = (message) => {
            alert(message);
        };

        onMounted(loadMap);

    return {
      map,
    };
  },
};
</script>