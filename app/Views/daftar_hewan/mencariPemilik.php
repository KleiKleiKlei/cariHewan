<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .pet-grid {
        padding: 2rem 0;
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
    }

    .pet-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        overflow: hidden;
    }

    .pet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .pet-img {
        height: 250px;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }

    .pet-info {
        padding: 1.5rem;
    }

    .pet-name {
        color: #FF69B4;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .pet-details {
        color: #666;
        font-size: 0.9rem;
    }

    .pet-modal .modal-content {
        border-radius: 15px;
        border: none;
    }

    .pet-modal .modal-header {
        background: linear-gradient(to right, #FFB6C1, #FF69B4);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }

    .pagination .page-item.active .page-link {
        background-color: #FF69B4;
        border-color: #FF69B4;
    }

    .pagination .page-link {
        color: #FF69B4;
    }

    .location-badge {
        background: #FFE4E1;
        color: #FF69B4;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    .ok-btn {
        position: relative;
        overflow: hidden;
        background: linear-gradient(to right, #FF69B4, #FFB6C1);
        border: none;
        transition: all 0.3s ease;
    }

    .ok-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
        background: linear-gradient(to right, #FF1493, #FF69B4);
    }

    .floating-emoji {
        position: absolute;
        pointer-events: none;
        animation: floatUp 1s ease-out forwards;
        opacity: 0;
        font-size: 1.2rem;
    }

    @keyframes floatUp {
        0% {
            transform: translateY(0) scale(0.5);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100px) scale(1.2) rotate(360deg);
            opacity: 0;
        }
    }

    .description-box {
        max-height: 150px;
        overflow-y: auto;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        white-space: pre-line;
    }
</style>

<div class="container-fluid pet-grid">
    <div class="container">
        <h2 class="text-center mb-4">Hewan Mencari Pemilik</h2>
        
        <div class="row">
            <?php 
            if (!empty($laporan)): 
                foreach ($laporan as $item): 
                    if ($item['status_admin'] === 'yes' && $item['tipe_laporan'] === 'Ditemukan'): 
            ?>
                <div class="col-md-4 mb-4">
                    <div class="pet-card" data-toggle="modal" data-target="#petModal<?= $item['id_laporan'] ?>">
                        <img src="<?= base_url('uploads/' . $item['foto_hewan']) ?>" class="w-100 pet-img" alt="<?= esc($item['nama_hewan']) ?>">
                        <div class="pet-info">
                            <div class="location-badge">
                                <i class="fas fa-map-marker-alt"></i> 
                                <?= esc($item['lokasi_terakhir']) ?>
                                <?php if ($item['latitude'] && $item['longitude']): ?>
                                    <a href="#" class="view-map" 
                                       data-lat="<?= esc($item['latitude']) ?>" 
                                       data-lng="<?= esc($item['longitude']) ?>"
                                       data-toggle="tooltip" 
                                       title="Lihat di Peta">
                                        <i class="fas fa-map ml-2"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <h5 class="pet-name"><?= esc($item['nama_hewan'] ?? 'Kucing Tanpa Nama') ?></h5>
                            <div class="pet-details">
                                <p class="mb-1"><i class="fas fa-paw mr-2"></i><?= esc($item['Jenis_hewan']) ?> - <?= esc($item['Ras_hewan']) ?></p>
                                <p class="mb-1"><i class="fas fa-palette mr-2"></i><?= esc($item['warna_bulu']) ?></p>
                                <p class="mb-0"><i class="far fa-clock mr-2"></i><?= date('d M Y', strtotime($item['tanggal_laporan'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for each pet -->
                <div class="modal fade pet-modal" id="petModal<?= $item['id_laporan'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Hewan Ditemukan</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="<?= base_url('uploads/' . $item['foto_hewan']) ?>" class="w-100 rounded" alt="<?= esc($item['nama_hewan']) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <h4><?= esc($item['nama_hewan'] ?? 'Kucing Tanpa Nama') ?></h4>
                                        <p><strong>Jenis:</strong> <?= esc($item['Jenis_hewan']) ?></p>
                                        <p><strong>Ras:</strong> <?= esc($item['Ras_hewan']) ?></p>
                                        <p><strong>Warna Bulu:</strong> <?= esc($item['warna_bulu']) ?></p>
                                        <p><strong>Warna Mata:</strong> <?= esc($item['warna_mata']) ?></p>
                                        <p><strong>Jenis Kelamin:</strong> <?= esc($item['jenis_kelamin']) ?></p>
                                        <p><strong>Ciri Khas:</strong> <?= esc($item['ciri_khas']) ?></p>
                                        <p><strong>Lokasi Ditemukan:</strong> <?= esc($item['lokasi_terakhir']) ?></p>
                                        <p><strong>Kontak Penemu:</strong> <?= esc($item['nomor_telepon']) ?></p>
                                        <p><strong>Deskripsi Lengkap:</strong></p>
                                        <div class="description-box p-3 bg-light rounded">
                                            <?= nl2br(esc($item['deskripsi_laporan'])) ?>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-primary ok-btn" data-dismiss="modal">
                                                <i class="fas fa-paw mr-2"></i> OK
                                                <span class="floating-emojis"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                    endif;
                endforeach; 
            else: 
            ?>
                <!-- Cat Placeholder -->
                <div class="col-md-4 mb-4">
                    <div class="pet-card" data-toggle="modal" data-target="#petModalPlaceholder">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/25/Siam_lilacpoint.jpg" class="w-100 pet-img" alt="Kucing Siamese">
                        <div class="pet-info">
                            <div class="location-badge">
                                <i class="fas fa-map-marker-alt"></i> Taman Flora, Surabaya
                            </div>
                            <h5 class="pet-name">Si Manis</h5>
                            <div class="pet-details">
                                <p class="mb-1"><i class="fas fa-paw mr-2"></i>Kucing - Siamese</p>
                                <p class="mb-1"><i class="fas fa-palette mr-2"></i>Putih Keabu-abuan</p>
                                <p class="mb-0"><i class="far fa-clock mr-2"></i><?= date('d M Y') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Placeholder Modal -->
                <div class="modal fade pet-modal" id="petModalPlaceholder" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Hewan Ditemukan</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/25/Siam_lilacpoint.jpg" class="w-100 rounded" alt="Kucing Siamese">
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Si Manis</h4>
                                        <p><strong>Jenis:</strong> Kucing</p>
                                        <p><strong>Ras:</strong> Siamese</p>
                                        <p><strong>Warna Bulu:</strong> Putih Keabu-abuan</p>
                                        <p><strong>Warna Mata:</strong> Biru</p>
                                        <p><strong>Jenis Kelamin:</strong> Betina</p>
                                        <p><strong>Ciri Khas:</strong> Memiliki pita merah di leher</p>
                                        <p><strong>Lokasi Ditemukan:</strong> Taman Flora, Surabaya</p>
                                        <p><strong>Kontak Penemu:</strong> 081234567890</p>
                                        <div class="mt-3">
                                            <button class="btn btn-primary ok-btn" data-dismiss="modal">
                                                <i class="fas fa-paw mr-2"></i> OK
                                                <span class="floating-emojis"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?= isset($pager) ? $pager->links() : '' ?>
        </div>
    </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lokasi Hewan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalMap" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AhxkjpzOgxUNak7N5k9sJRQDv5EM8ZjVCsnI9ud9ZY6ZSpgXtJFxNnLnaIf1b0WE'></script>
<script>
    $(document).ready(function() {
        $('.view-map').click(function(e) {
            e.preventDefault();
            const lat = $(this).data('lat');
            const lng = $(this).data('lng');
            
            $('#mapModal').modal('show');
            
            setTimeout(() => {
                const map = new Microsoft.Maps.Map('#modalMap', {
                    credentials: 'AhxkjpzOgxUNak7N5k9sJRQDv5EM8ZjVCsnI9ud9ZY6ZSpgXtJFxNnLnaIf1b0WE',
                    center: new Microsoft.Maps.Location(lat, lng),
                    zoom: 15
                });
                
                const pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(lat, lng));
                map.entities.push(pin);
            }, 500);
        });

        $('.ok-btn').click(function(e) {
            const emojis = ['🐱', '🐶', '🐾', '💗', '✨'];
            const button = $(this);
            
            // Create multiple emojis
            for(let i = 0; i < 5; i++) {
                setTimeout(() => {
                    const emoji = $('<span>')
                        .addClass('floating-emoji')
                        .text(emojis[Math.floor(Math.random() * emojis.length)])
                        .css({
                            left: Math.random() * 100 + '%',
                            bottom: '100%'
                        });
                    
                    button.append(emoji);
                    
                    // Remove emoji element after animation
                    setTimeout(() => emoji.remove(), 1000);
                }, i * 100);
            }
        });
    });
</script>
<?= $this->endSection() ?>