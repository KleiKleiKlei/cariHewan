<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1>Daftar Hewan Ditemukan</h1>

<form action="/daftar_hewan/ditemukan" method="get">
    <input type="text" name="lokasi" placeholder="Lokasi">
    <input type="text" name="jenis" placeholder="Jenis Hewan">
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<?php foreach ($laporan as $l) : ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $l['deskripsi_laporan'] ?></h5>
        </div>
    </div>
<?php endforeach; ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>