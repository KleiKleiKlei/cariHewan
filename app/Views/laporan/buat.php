<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .report-section {
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
        border-radius: 20px;
        padding: 4rem 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin: 3rem auto;
        max-width: 800px;
    }

    .title-section {
        text-align: center;
        margin-bottom: 3rem;
    }

    .title-section h1 {
        color: #FF69B4;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .title-section p {
        color: #666;
        font-size: 1.1rem;
    }

    .report-options {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .report-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        width: 300px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .report-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .lost-icon {
        color: #FF69B4;
    }

    .found-icon {
        color: #4CAF50;
    }

    .btn-report {
        display: inline-block;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-lost {
        background: #FF69B4;
        color: white;
    }

    .btn-lost:hover {
        background: #FF1493;
        color: white;
        transform: scale(1.05);
    }

    .btn-found {
        background: #4CAF50;
        color: white;
    }

    .btn-found:hover {
        background: #45a049;
        color: white;
        transform: scale(1.05);
    }
</style>

<div class="container">
    <div class="report-section">
        <div class="title-section">
            <h1><i class="fas fa-file-alt mr-2"></i>Buat Laporan</h1>
            <p>Pilih jenis laporan yang ingin Anda buat</p>
        </div>

        <div class="report-options">
            <div class="report-card">
                <div class="report-icon lost-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Hewan Hilang</h3>
                <p>Laporkan hewan peliharaan Anda yang hilang</p>
                <a href="<?= base_url('laporan/lost') ?>" class="btn-report btn-lost">
                    <i class="fas fa-paw mr-2"></i>Buat Laporan
                </a>
            </div>

            <div class="report-card">
                <div class="report-icon found-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3>Hewan Ditemukan</h3>
                <p>Laporkan hewan yang Anda temukan</p>
                <a href="<?= base_url('laporan/ditemukan') ?>" class="btn-report btn-found">
                    <i class="fas fa-home mr-2"></i>Buat Laporan
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>