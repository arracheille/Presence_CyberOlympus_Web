<script>
    var platform = new H.service.Platform({
            apikey: "yourapikey"
        });
        var engineType = H.Map.EngineType['HARP'];
        var defaultLayers = platform.createDefaultLayers({
        	engineType: engineType,
          pois: true
        });
        var map = new H.Map(document.getElementById('map'),
            defaultLayers.vector.normal.map, {
            center: {lat: 52.53086, lng: 13.38469},
            zoom: 18,
            engineType: H.Map.EngineType['HARP'],
            pixelRatio: window.devicePixelRatio || 1
        });

        var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
        var ui = H.ui.UI.createDefault(map, defaultLayers);
        var searchService = platform.getSearchService();
        var geofenceShape;
        var markers = [];
        var someThresholdDistance = 20; // 20 meters threshold

        // Function to update the geofence shape
        function updateGeofenceShape() {
            if (geofenceShape) {
                map.removeObject(geofenceShape);
            }

            if (markers.length > 1) {
                var lineString = new H.geo.LineString();
                markers.forEach(marker => lineString.pushPoint(marker.getGeometry()));

                // Close the shape if the last marker is near the first marker
                if (markers[markers.length - 1].getGeometry().distance(markers[0].getGeometry()) * 1000 < someThresholdDistance) {
                    lineString.pushPoint(markers[0].getGeometry());
                }

                geofenceShape = new H.map.Polygon(lineString, {
                    style: {
                        fillColor: 'rgba(55, 85, 170, 0.4)',
                        lineWidth: 2,
                        strokeColor: 'rgba(55, 85, 170, 1)'
                    }
                });
                map.addObject(geofenceShape);
            }
        }
// Function to add a draggable marker
function addDraggableMarker(coord) {
    var svgMarkup = '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg">' +
                    '<circle cx="12" cy="12" r="10" stroke="black" stroke-width="2" fill="white" />' +
                    '</svg>';

    var icon = new H.map.Icon(svgMarkup);
    var marker = new H.map.Marker(coord, { icon: icon, volatility: true });
    marker.draggable = true;
    map.addObject(marker);
    markers.push(marker);
}

        // Function to clear the geofence and markers
        function clearGeofence() {
            if (geofenceShape) {
                map.removeObject(geofenceShape);
                geofenceShape = null;
            }
            markers.forEach(marker => map.removeObject(marker));
            markers = [];
        }

        // Event listener for map click
        map.addEventListener('tap', function(evt) {
            var coord = map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY);
            addDraggableMarker(coord);
            updateGeofenceShape();
        });

        // Event listener for marker drag
        map.addEventListener('dragstart', function(evt) {
            var target = evt.target;
            if (target instanceof H.map.Marker) {
                behavior.disable();
            }
        }, false);

        map.addEventListener('dragend', function(evt) {
            var target = evt.target;
            if (target instanceof H.map.Marker) {
                behavior.enable();
                updateGeofenceShape();
            }
        }, false);

        map.addEventListener('drag', function(evt) {
            var target = evt.target;
            if (target instanceof H.map.Marker) {
                target.setGeometry(map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY));
            }
        }, false);

        // Event listener for the clear button
        document.getElementById('clear-btn').addEventListener('click', clearGeofence);

        // Autosuggest functionality
        function startSearch(query) {
            if (query.trim() === '') {
                clearSuggestions();
                return;
            }

            searchService.autosuggest({
                q: query,
                at: map.getCenter().lat + ',' + map.getCenter().lng
            }, (result) => {
                displaySuggestions(result.items);
            }, (error) => {
                console.error('Autosuggest error:', error);
            });
        }

        function clearSuggestions() {
            var suggestionsContainer = document.getElementById('suggestions');
            if (suggestionsContainer) {
                suggestionsContainer.innerHTML = '';
            }
        }

        function displaySuggestions(items) {
            var suggestionsContainer = document.getElementById('suggestions');
            if (suggestionsContainer) {
                suggestionsContainer.innerHTML = '';
                items.forEach(function(item) {
                    var div = document.createElement('div');
                    div.innerHTML = item.title;
                    div.onclick = function() {
                        map.setCenter(item.position);
                        map.setZoom(14);
                        suggestionsContainer.innerHTML = '';
                    };
                    suggestionsContainer.appendChild(div);
                });
            }
        }

        document.getElementById('searchInput').addEventListener('input', function(evt) {
            startSearch(evt.target.value);
        });
</script>