<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .profile-container {
        padding: 3rem 0;
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
        min-height: 80vh;
    }

    .profile-card {
        background: white;
        border-radius: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(to right, #FFB6C1, #FF69B4);
        padding: 2rem;
        color: white;
        text-align: center;
        position: relative;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        background: #fff;
        border-radius: 50%;
        padding: 3px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-avatar i {
        font-size: 3rem;
        color: #FF69B4;
    }

    .profile-body {
        padding: 2rem;
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-label {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .info-value {
        color: #333;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .profile-actions {
        padding: 1rem 2rem 2rem;
    }

    .btn-logout {
        background: #ff6b6b;
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-logout:hover {
        background: #ff5252;
        transform: translateY(-2px);
        color: white;
    }

    .pet-decoration {
        position: absolute;
        bottom: -15px;
        right: 20px;
        font-size: 2rem;
        opacity: 0.5;
        transform: rotate(15deg);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .floating-paws {
        position: absolute;
        color: rgba(255,255,255,0.3);
        animation: float 3s infinite ease-in-out;
    }

    .paw1 { top: 20px; left: 10%; font-size: 1.5rem; animation-delay: 0s; }
    .paw2 { top: 50px; right: 15%; font-size: 2rem; animation-delay: 0.5s; }
    .paw3 { bottom: 30px; left: 20%; font-size: 1.8rem; animation-delay: 1s; }

    .yarn-ball {
        position: absolute;
        font-size: 1.2rem;
        color: #fff;
        pointer-events: none;
        opacity: 0;
    }

    @keyframes playWithYarn {
        0% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(-20px, -15px) rotate(-45deg); }
        50% { transform: translate(20px, -25px) rotate(45deg); }
        75% { transform: translate(-15px, -10px) rotate(-30deg); }
        100% { transform: translate(0, 0) rotate(0deg); }
    }

    @keyframes yarnFly {
        0% { transform: translate(0, 0); opacity: 1; }
        100% { transform: translate(var(--x), var(--y)); opacity: 0; }
    }
</style>

<div class="profile-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <div class="profile-header">
                        <i class="fas fa-paw floating-paws paw1"></i>
                        <i class="fas fa-paw floating-paws paw2"></i>
                        <i class="fas fa-paw floating-paws paw3"></i>
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h2><?= esc($user['nama']) ?></h2>
                        <p class="mb-0"><?= esc($user['email']) ?></p>
                        <div class="pet-decoration">
                            <i class="fas fa-cat"></i>
                        </div>
                    </div>

                    <div class="profile-body">
                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-user mr-2"></i>Nama Lengkap
                            </div>
                            <div class="info-value"><?= esc($user['nama']) ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-envelope mr-2"></i>Email
                            </div>
                            <div class="info-value"><?= esc($user['email']) ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-phone mr-2"></i>Nomor Telepon
                            </div>
                            <div class="info-value"><?= esc($user['nomor_telepon']) ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-calendar-alt mr-2"></i>Bergabung Sejak
                            </div>
                            <div class="info-value"><?= date('d F Y', strtotime($user['created_at'])) ?></div>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <a href="<?= base_url('logout') ?>" class="btn btn-logout" id="logoutBtn">
                            <i class="fas fa-sign-out-alt"></i>
                            Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('.pet-decoration').addEventListener('click', function(e) {
    const cat = this;
    cat.style.animation = 'playWithYarn 1s ease-in-out';
    
    // Create multiple yarn balls
    for (let i = 0; i < 5; i++) {
        const yarn = document.createElement('span');
        yarn.innerHTML = '🧶';
        yarn.className = 'yarn-ball';
        yarn.style.position = 'absolute';
        yarn.style.left = e.clientX + 'px';
        yarn.style.top = e.clientY + 'px';
        
        // Random direction for each yarn ball
        const angle = (Math.random() * Math.PI * 2);
        const distance = 100 + Math.random() * 100;
        const x = Math.cos(angle) * distance;
        const y = Math.sin(angle) * distance;
        
        yarn.style.setProperty('--x', `${x}px`);
        yarn.style.setProperty('--y', `${y}px`);
        
        document.body.appendChild(yarn);
        
        // Animate the yarn
        requestAnimationFrame(() => {
            yarn.style.animation = `yarnFly 1s ease-out forwards`;
            yarn.style.animationDelay = `${i * 0.1}s`;
        });
        
        // Clean up
        setTimeout(() => yarn.remove(), 1000 + (i * 100));
    }
    
    // Reset cat animation
    setTimeout(() => {
        cat.style.animation = '';
    }, 1000);
});

document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault();
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        // Create and show the goodbye toast
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = `
            <div class="icon">👋</div>
            <div class="message">Sampai jumpa kembali!</div>
        `;
        document.body.appendChild(toast);

        // Show the toast with animation
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        // Redirect after showing toast
        setTimeout(() => {
            window.location.href = this.href;
        }, 2000);
    }
});
</script>
<?= $this->endSection() ?>