<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .auth-container {
        max-width: 450px;
        margin: 60px auto;
        padding: 40px;
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
        box-shadow: 0 15px 30px rgba(255, 182, 193, 0.2);
        border-radius: 25px;
        border: 2px solid #FFB6C1;
        position: relative;
        overflow: hidden;
    }

    .auth-container::before {
        content: '🐾';
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 24px;
        opacity: 0.5;
    }

    .auth-container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #FF69B4;
        font-size: 2.2rem;
        font-weight: 600;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        position: relative;
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 600;
        color: #FF69B4;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 2px solid #FFB6C1;
        border-radius: 15px;
        padding: 12px 20px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }

    .form-control:focus {
        border-color: #FF69B4;
        box-shadow: 0 0 15px rgba(255, 105, 180, 0.1);
        transform: translateY(-2px);
    }

    .btn-primary {
        width: 100%;
        background: linear-gradient(to right, #FF69B4, #FFB6C1);
        border: none;
        padding: 12px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #FF1493, #FF69B4);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 105, 180, 0.2);
    }

    .auth-container p {
        text-align: center;
        margin-top: 25px;
        color: #666;
    }

    .auth-container a {
        color: #FF69B4;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .auth-container a:hover {
        color: #FF1493;
        text-decoration: underline;
    }

    .alert-danger {
        background: rgba(255, 105, 180, 0.1);
        border: 1px solid #FF69B4;
        color: #FF1493;
        border-radius: 15px;
        padding: 12px 20px;
        margin-bottom: 20px;
        font-size: 0.9em;
    }

    /* Paw print decorations */
    .paw-prints {
        position: absolute;
        font-size: 20px;
        opacity: 0.1;
        color: #FF69B4;
    }

    .paw1 { top: 10%; left: 10%; transform: rotate(-45deg); }
    .paw2 { top: 40%; right: 5%; transform: rotate(45deg); }
    .paw3 { bottom: 15%; left: 5%; transform: rotate(-30deg); }

    /* Input group icons */
    .input-icon {
        position: absolute;
        right: 15px;
        top: 42px;
        color: #FFB6C1;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .auth-container::after {
        content: '🐱';
        position: absolute;
        bottom: 20px;
        right: 20px;
        font-size: 32px;
        animation: float 3s infinite ease-in-out;
    }
</style>

<div class="auth-container">
    <span class="paw-prints paw1">🐾</span>
    <span class="paw-prints paw2">🐾</span>
    <span class="paw-prints paw3">🐾</span>

    <h2><i class="fas fa-paw mr-2"></i>Masuk</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('auth/processLogin') ?>" method="post">
        <div class="form-group">
            <label for="email"><i class="fas fa-envelope mr-2"></i>Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" required>
            <span class="input-icon"><i class="fas fa-envelope"></i></span>
        </div>

        <div class="form-group">
            <label for="password"><i class="fas fa-lock mr-2"></i>Kata Sandi</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <span class="input-icon"><i class="fas fa-lock"></i></span>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paw mr-2"></i>Masuk
        </button>
        
        <p class="mt-3">
            Belum punya akun? 
            <a href="<?= base_url('register') ?>">Daftar di sini</a>
        </p>
    </form>
</div>

<?= $this->endSection() ?>
