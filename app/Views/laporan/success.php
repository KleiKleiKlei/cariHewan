<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <h1 class="text-success mb-4"><i class="fas fa-check-circle"></i></h1>
            <h2 class="card-title mb-4">Terima Kasih!</h2>
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php endif ?>
            <p class="card-text">Laporan Anda telah berhasil disimpan dan akan segera diproses.</p>
            <div class="mt-4">
                <a href="<?= base_url('laporan') ?>" class="btn btn-primary">Kembali ke Daftar Laporan</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>