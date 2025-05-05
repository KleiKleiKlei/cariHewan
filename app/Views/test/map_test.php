<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    #map {
        height: 500px;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .container {
        height: 100%;
        padding: 20px;
    }
</style>

<div class="container">
    <h3>Map Test Page</h3>
    <div id="map"></div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var map;
    function initMap() {
        console.log('Map initialization starting...');
        try {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -6.200000, lng: 106.816666},
                zoom: 12,
                mapTypeId: 'roadmap'
            });
            console.log('Map created successfully');
        } catch(e) {
            console.error('Error creating map:', e);
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v6.9/mapsJavaScriptAPI.js" async defer></script>
<?= $this->endSection() ?>