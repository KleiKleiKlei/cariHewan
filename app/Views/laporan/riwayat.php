<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .history-container {
        padding: 2rem 0;
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
        min-height: 100vh;
    }

    .report-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .report-header {
        padding: 1rem;
        background: linear-gradient(to right, #FFB6C1, #FF69B4);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .report-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        background: rgba(255, 255, 255, 0.2);
    }

    .report-body {
        display: flex;
        padding: 1rem;
    }

    .report-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 1rem;
    }

    .report-info {
        flex: 1;
    }

    .pet-name {
        color: #FF69B4;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .report-details {
        color: #666;
        font-size: 0.9rem;
    }

    .report-actions {
        padding: 1rem;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .btn-delete {
        background: #ff6b6b;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: #ff5252;
        transform: scale(1.05);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: #FFB6C1;
        margin-bottom: 1rem;
    }
</style>

<div class="history-container">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <h2 class="text-center mb-4">Riwayat Laporan Saya</h2>
        
        <?php if (!empty($laporan)): ?>
            <?php foreach ($laporan as $item): ?>
                <div class="report-card">
                    <div class="report-header">
                        <span>
                            <i class="<?= $item['tipe_laporan'] === 'Hilang' ? 'fas fa-search' : 'fas fa-hand-holding-heart' ?>"></i>
                            Laporan <?= $item['tipe_laporan'] ?>
                        </span>
                        <span class="report-status">
                            <?php if ($item['status_admin'] === 'yes'): ?>
                                <i class="fas fa-check-circle"></i> Disetujui
                            <?php elseif ($item['status_admin'] === 'no'): ?>
                                <i class="fas fa-times-circle"></i> Ditolak
                            <?php else: ?>
                                <i class="fas fa-clock"></i> Menunggu
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="report-body">
                        <img src="<?= base_url('uploads/' . $item['foto_hewan']) ?>" class="report-img" alt="<?= esc($item['nama_hewan']) ?>">
                        <div class="report-info">
                            <h5 class="pet-name"><?= esc($item['nama_hewan']) ?></h5>
                            <div class="report-details">
                                <p class="mb-1">
                                    <i class="fas fa-paw mr-2"></i>
                                    <?= esc($item['Jenis_hewan']) ?> - <?= esc($item['Ras_hewan']) ?>
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <?= esc($item['lokasi_terakhir']) ?>
                                </p>
                                <p class="mb-1">
                                    <i class="far fa-calendar mr-2"></i>
                                    <?= date('d M Y', strtotime($item['tanggal_laporan'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button type="button" class="btn btn-delete" onclick="confirmDelete(<?= $item['id_laporan'] ?>)">
                            <i class="fas fa-trash-alt"></i> Hapus Laporan
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Belum Ada Laporan</h3>
                <p class="text-muted">Anda belum membuat laporan apapun</p>
                <a href="<?= base_url('laporan/buat') ?>" class="btn btn-pink mt-3">
                    <i class="fas fa-plus"></i> Buat Laporan
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
        window.location.href = '<?= base_url('laporan/delete/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>