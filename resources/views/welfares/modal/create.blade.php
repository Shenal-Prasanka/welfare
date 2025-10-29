<!-- Modal -->
<div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="m-0 font-weight-bold text-white">{{ __('Add New Welfare') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('welfares.store') }}" enctype="multipart/form-data" novalidate
                    id="welfareForm">
                    @csrf

                    <!-- Welfare Field -->
                    <div class="col-md-12">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('Enter Welfare Name') }}" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="location">{{ __('Location Coordinates') }}</label>
                        <div class="input-group">
                            <input type="text" name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror"
                                placeholder="Click on the map to select location" value="{{ old('location') }}"
                                readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="getCurrentLocation()">
                                    <i class="fas fa-location-arrow"></i> {{ __('Current Location') }}
                                </button>
                            </div>
                        </div>
                        @error('location')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Map -->
                    <div class="mt-2">
                        <div id="map"
                            style="height: 500px; width: 100%; border: 1px solid #ccc; border-radius: 4px;"></div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-primary">{{ __('Add Welfare') }}</button>
                        <button type="button" class="btn btn-warning"
                            data-dismiss="modal">{{ __('Back') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let map, marker, mapInitialized = false;

    function initMap() {
        if (mapInitialized) {
            setTimeout(() => map.invalidateSize(), 200); // Resize map if already initialized
            return;
        }

        // Initialize Leaflet Map
        map = L.map('map').setView([7.8731, 80.7718], 7); // Default center: Sri Lanka

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Map click event
        map.on('click', function(e) {
            addMarker(e.latlng.lat, e.latlng.lng);
        });

        mapInitialized = true;
    }

   function addMarker(lat, lng) {
    if (marker) map.removeLayer(marker);

    marker = L.marker([lat, lng]).addTo(map)
        .bindPopup("Selected Location").openPopup();

    // Save coordinates only
    document.getElementById('location').value = `${lat},${lng}`;

}



    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                addMarker(lat, lng);
                map.setView([lat, lng], 15);
            }, function() {
                alert("Unable to retrieve your location.");
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Initialize map only after modal is fully shown
    $('#ModalCreate').on('shown.bs.modal', function() {
        initMap();
        setTimeout(() => map.invalidateSize(), 100); // Ensure map fits container
    });
</script>
