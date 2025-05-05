<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1>Laporan</h1>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="/laporan/buat" class="btn btn-primary">Buat Laporan</a>
<a href="/riwayat-laporan" class="btn btn-secondary">Riwayat Laporan</a>
<a href="/laporan/hilang" class="btn btn-primary">List Hewan Hilang</a>
<a href="/laporan/mencari_pemilik" class="btn btn-secondary">List Hewan Mencari Pemilik</a>
<a href="/laporan/ditemukan" class="btn btn-success">List Hewan Ditemukan</a>

<?= $this->endSection() ?>