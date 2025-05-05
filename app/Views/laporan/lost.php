<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    #map { background: #f0f0f0; }
</style>
<div class="container mt-5">
    <h2>Laporan Hewan Hilang</h2>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->get('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('laporan/saveLost') ?>" method="post" enctype="multipart/form-data">
        <!-- Pet Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informasi Hewan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_hewan" class="form-label">Nama Hewan</label>
                            <input type="text" class="form-control" id="nama_hewan" name="nama_hewan" required>
                        </div>
                        <div class="mb-3">
                            <label for="Jenis_hewan" class="form-label">Jenis Hewan</label>
                            <input type="text" class="form-control" id="Jenis_hewan" name="Jenis_hewan" required>
                        </div>
                        <div class="mb-3">
                            <label for="Ras_hewan" class="form-label">Ras Hewan</label>
                            <input type="text" class="form-control" id="Ras_hewan" name="Ras_hewan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="warna_bulu" class="form-label">Warna Bulu</label>
                            <input type="text" class="form-control" id="warna_bulu" name="warna_bulu" required>
                        </div>
                        <div class="mb-3">
                            <label for="warna_mata" class="form-label">Warna Mata</label>
                            <input type="text" class="form-control" id="warna_mata" name="warna_mata" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Jantan">Jantan</option>
                                <option value="Betina">Betina</option>
                                <option value="Tidak Tahu">Tidak Tahu</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ciri_khas" class="form-label">Ciri Khas</label>
                    <textarea class="form-control" id="ciri_khas" name="ciri_khas" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_hewan" class="form-label">Foto Hewan</label>
                    <input type="file" class="form-control" id="foto_hewan" name="foto_hewan" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Report Information -->
        <div class="container my-5">

            <!-- Deskripsi Laporan -->
            <div class="mb-3">
                <label for="deskripsi_laporan" class="form-label">Deskripsi Lengkap</label>
                <textarea class="form-control" id="deskripsi_laporan" name="deskripsi_laporan" rows="3" required></textarea>
            </div>

            <!-- Lokasi Terakhir -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Lokasi pada Peta</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="lokasi_terakhir" class="form-label">Lokasi Terakhir</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="lokasi_terakhir" name="lokasi_terakhir" 
                                   placeholder="Tulis nama lokasi atau pilih di peta" required>
                            <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                        <div id="map" style="height: 300px; width: 100%; border-radius: 8px; position: relative;"></div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary" id="confirmLocation">
                                <i class="fas fa-map-marker-alt"></i> Konfirmasi Lokasi
                            </button>
                        </div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Kirim Laporan</button>
            </div>

        </div>
    </form>
</div>

<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AhxkjpzOgxUNak7N5k9sJRQDv5EM8ZjVCsnI9ud9ZY6ZSpgXtJFxNnLnaIf1b0WE'></script>
<script>
    let map, searchManager, currentPin;

    function initializeMap() {
        // Create the map first
        map = new Microsoft.Maps.Map('#map', {
            credentials: 'AhxkjpzOgxUNak7N5k9sJRQDv5EM8ZjVCsnI9ud9ZY6ZSpgXtJFxNnLnaIf1b0WE',
            center: new Microsoft.Maps.Location(-7.2575, 112.7521), // Default center (will be updated)
            zoom: 15,
            mapTypeId: Microsoft.Maps.MapTypeId.road
        });

        // Try to get user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    // Success: Update map with user's location
                    const userLocation = new Microsoft.Maps.Location(
                        position.coords.latitude,
                        position.coords.longitude
                    );
                    map.setView({ center: userLocation });
                    addDraggablePin(userLocation);
                    reverseGeocode(userLocation);
                },
                function(error) {
                    // Error: Fall back to default pin at Surabaya
                    console.log('Geolocation error:', error);
                    let defaultLocation = map.getCenter();
                    addDraggablePin(defaultLocation);
                }
            );
        } else {
            // Geolocation not supported: Use default location
            let defaultLocation = map.getCenter();
            addDraggablePin(defaultLocation);
        }

        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
            searchManager = new Microsoft.Maps.Search.SearchManager(map);
            
            // Search button click handler
            document.getElementById('searchBtn').addEventListener('click', searchLocation);
            
            // Search input enter key handler
            document.getElementById('lokasi_terakhir').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchLocation();
                }
            });

            // Map click handler
            Microsoft.Maps.Events.addHandler(map, 'click', function (e) {
                addDraggablePin(e.location);
                reverseGeocode(e.location);
            });

            // Confirm location button handler
            document.getElementById('confirmLocation').addEventListener('click', function() {
                if (currentPin) {
                    let location = currentPin.getLocation();
                    document.getElementById('latitude').value = location.latitude;
                    document.getElementById('longitude').value = location.longitude;
                    // Visual feedback
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                    this.innerHTML = '<i class="fas fa-check"></i> Lokasi Dikonfirmasi';
                    // Optional: Disable pin dragging after confirmation
                    currentPin.setOptions({ draggable: false });
                }
            });
        });
    }

    function addDraggablePin(location) {
        // Remove existing pin if any
        if (currentPin) {
            map.entities.remove(currentPin);
        }

        currentPin = new Microsoft.Maps.Pushpin(location, {
            color: 'red',
            draggable: true
        });

        // Add dragend handler
        Microsoft.Maps.Events.addHandler(currentPin, 'dragend', function () {
            let loc = currentPin.getLocation();
            reverseGeocode(loc);
            // Reset confirm button
            let confirmBtn = document.getElementById('confirmLocation');
            confirmBtn.classList.remove('btn-success');
            confirmBtn.classList.add('btn-primary');
            confirmBtn.innerHTML = '<i class="fas fa-map-marker-alt"></i> Konfirmasi Lokasi';
        });

        map.entities.push(currentPin);
    }

    function searchLocation() {
        let searchQuery = document.getElementById('lokasi_terakhir').value;
        let requestOptions = {
            where: searchQuery,
            callback: function (answer) {
                if (answer.results && answer.results.length > 0) {
                    let location = answer.results[0].location;
                    map.setView({ center: location, zoom: 15 });
                    addDraggablePin(location);
                    document.getElementById('lokasi_terakhir').value = answer.results[0].name;
                } else {
                    alert('Lokasi tidak ditemukan');
                }
            },
            errorCallback: function (e) {
                alert("Pencarian gagal: " + e.message);
            }
        };
        searchManager.geocode(requestOptions);
    }

    function reverseGeocode(location) {
        let reverseGeocodeRequestOptions = {
            location: location,
            callback: function (answer) {
                if (answer.address && answer.address.formattedAddress) {
                    document.getElementById('lokasi_terakhir').value = answer.address.formattedAddress;
                }
            }
        };
        searchManager.reverseGeocode(reverseGeocodeRequestOptions);
    }

    // Initialize map when page loads
    window.onload = initializeMap;
</script>
<?= $this->endSection() ?>