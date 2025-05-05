<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div style="text-align: center; margin-top: 100px;">
    <h2>Registrasi Berhasil!</h2>
    <p>Anda akan diarahkan ke beranda dalam beberapa detik...</p>
</div>

<script>
    setTimeout(function() {
        window.location.href = '<?= base_url('/') ?>';
    }, 3000); // 3 seconds
</script>

<?= $this->endSection() ?>
