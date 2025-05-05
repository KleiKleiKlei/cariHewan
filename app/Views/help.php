<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .help-container {
        padding: 3rem 0;
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
        min-height: 80vh;
    }

    .help-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .help-card:hover {
        transform: translateY(-5px);
    }

    .help-icon {
        font-size: 2.5rem;
        color: #FF69B4;
        margin-bottom: 1rem;
        animation: bounce 2s infinite;
    }

    .help-title {
        color: #FF69B4;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .help-text {
        color: #666;
        line-height: 1.6;
    }

    .contact-section {
        text-align: center;
        margin-top: 3rem;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .social-links {
        margin-top: 1.5rem;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #FF69B4;
        color: white;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        transform: scale(1.1);
        background: #FF1493;
    }

    .contact-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        max-width: 300px;
        margin: 1.5rem auto;
    }

    .contact-btn {
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
    }

    .instagram-btn {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        color: white;
        border: none;
    }

    .form-btn {
        background: linear-gradient(to right, #FF69B4, #FFB6C1);
        color: white;
        border: none;
    }

    .contact-btn:hover {
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .instagram-btn:hover {
        background: linear-gradient(45deg, #e6683c 0%, #dc2743 25%, #cc2366 50%, #bc1888 75%, #f09433 100%);
    }

    .form-btn:hover {
        background: linear-gradient(to right, #FF1493, #FF69B4);
    }

    .cute-widget {
        margin-top: 2rem;
        padding: 1.5rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(255, 105, 180, 0.15);
        text-align: center;
    }

    .paw-print {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        animation: bounce 2s infinite;
    }

    .widget-text {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .cute-pets {
        font-size: 1.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .pet {
        display: inline-block;
    }

    .bounce {
        animation: bounce 2s infinite;
    }

    .bounce-delay {
        animation: bounce 2s infinite 0.5s;
    }

    .heart {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<div class="help-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Bantuan CariHewan</h2>
                
                <!-- Lapor Hewan Hilang -->
                <div class="help-card">
                    <div class="text-center">
                        <div class="help-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="help-title">Cara Melaporkan Hewan Hilang</h3>
                    </div>
                    <div class="help-text">
                        <ol>
                            <li>Login ke akun Anda</li>
                            <li>Klik menu "Laporan" lalu pilih "Buat Laporan"</li>
                            <li>Isi informasi lengkap tentang hewan Anda</li>
                            <li>Tambahkan foto yang jelas</li>
                            <li>Tandai lokasi terakhir di peta</li>
                            <li>Klik "Kirim Laporan"</li>
                        </ol>
                    </div>
                </div>

                <!-- Lapor Hewan Ditemukan -->
                <div class="help-card">
                    <div class="text-center">
                        <div class="help-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="help-title">Cara Melaporkan Hewan yang Ditemukan</h3>
                    </div>
                    <div class="help-text">
                        <ol>
                            <li>Login ke akun Anda</li>
                            <li>Klik menu "Laporan" lalu pilih "Buat Laporan"</li>
                            <li>Pilih opsi "Hewan Ditemukan"</li>
                            <li>Isi informasi detail hewan</li>
                            <li>Tambahkan foto yang jelas</li>
                            <li>Tandai lokasi penemuan di peta</li>
                            <li>Klik "Kirim Laporan"</li>
                        </ol>
                    </div>
                </div>

                <!-- Tips -->
                <div class="help-card">
                    <div class="text-center">
                        <div class="help-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="help-title">Tips Pencarian</h3>
                    </div>
                    <div class="help-text">
                        <ul>
                            <li>Gunakan foto terbaru dan jelas</li>
                            <li>Berikan ciri khas yang detail</li>
                            <li>Tandai lokasi dengan tepat</li>
                            <li>Periksa halaman "Hewan Ditemukan" secara rutin</li>
                            <li>Bagikan laporan ke media sosial</li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="contact-section">
                    <h3 class="help-title">Butuh Bantuan Lebih?</h3>
                    <p class="help-text">Hubungi kami melalui:</p>
                    <div class="contact-buttons">
                        <a href="https://www.instagram.com/cari_hewan/" target="_blank" class="btn contact-btn instagram-btn">
                            <i class="fab fa-instagram mr-2"></i>
                            Follow Instagram Kami
                        </a>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfiDIh85wJ7mY6nXsJPMI3RcP5oidjHczN6k2JyKqlV-_Z--A/viewform?usp=sharing" 
                           target="_blank" class="btn contact-btn form-btn">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Feedback
                        </a>
                    </div>
                    <div class="cute-widget">
                        <div class="paw-print">🐾</div>
                        <p class="widget-text">Terima kasih telah membantu<br>mencarikan hewan yang hilang! </p>
                        <div class="cute-pets">
                            <span class="pet bounce">🐱</span>
                            <span class="heart pulse">💗</span>
                            <span class="pet bounce-delay">🐶</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>