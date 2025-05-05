<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Lost and Found Hewan' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background: linear-gradient(to right, #FFE5E5, #FFF0F5) !important;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 600;
            color: #FF69B4 !important;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: #555 !important;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: #FFB6C1;
            color: white !important;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 10px;
            background: #fff;
            margin-top: 10px;
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 8px 20px;
            transition: all 0.2s ease;
            color: #555;
        }

        .dropdown-item:hover {
            background-color: #FFE4E1;
            transform: translateX(5px);
            color: #FF69B4;
        }

        .user-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #FF69B4;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .user-icon:hover {
            transform: scale(1.1);
            background: #FF1493;
        }

        .help-button {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #FF69B4;
            color: white !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .help-button:hover {
            background: #FF1493;
            transform: rotate(15deg);
        }

        .alert-success {
            font-size: 0.95em;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            animation: fadeInSlideDown 0.5s ease;
        }

        @keyframes fadeInSlideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .popup {
            position: fixed;
            top: -100%;
            left: 50%;
            transform: translateX(-50%);
            background: #fff0f5;
            border: 2px solid #ff69b4;
            border-radius: 12px;
            padding: 20px 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            z-index: 1050;
            transition: top 0.5s ease-in-out;
        }

        .popup.show {
            top: 100px;
        }

        .popup-content h3 {
            margin-top: 0;
            color: #c71585;
            font-family: 'Comic Sans MS', cursive;
        }

        .popup-content p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .btn-pink {
            background-color: #ff69b4;
            color: white;
            border: none;
        }

        .btn-pink:hover {
            background-color: #ff1493;
        }

        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
            border: 2px solid #FFB6C1;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.5s ease forwards;
        }

        .welcome-pet {
            font-size: 2.5rem;
            animation: bounce 2s infinite;
            display: inline-block;
            margin-right: 10px;
            transform-origin: bottom;
        }

        @keyframes bounce {
            0%, 100% { 
                transform: translateY(0) rotate(0deg); 
            }
            25% { 
                transform: translateY(-15px) rotate(-5deg); 
            }
            35% { 
                transform: translateY(0) rotate(0deg); 
            }
            45% { 
                transform: translateY(-5px) rotate(5deg); 
            }
            55% { 
                transform: translateY(0) rotate(0deg); 
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<!-- Add this right after your <body> tag -->
<?php if(session()->has('success')): ?>
    <div class="toast-notification">
        <span class="welcome-pet">🐱</span>
        <div class="message"><?= session()->get('success') ?></div>
    </div>
    <script>
        setTimeout(() => {
            document.querySelector('.toast-notification').style.opacity = '0';
            setTimeout(() => {
                document.querySelector('.toast-notification').remove();
            }, 500);
        }, 3000);

        // Random pet selection
        const pets = ['🐱', '🐶', '🐰', '🐹', '🦊', '🐼'];
        const welcomePet = document.querySelector('.welcome-pet');
        welcomePet.textContent = pets[Math.floor(Math.random() * pets.length)];
    </script>
<?php endif; ?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="<?= base_url('') ?>">
            <i class="fas fa-paw"></i> CariHewan
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-center">
                
                <?php if (!session()->get('user_id')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>">
                            <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('register') ?>">
                            <i class="fas fa-user-plus mr-1"></i> Daftar
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="lostFoundDropdown" data-toggle="dropdown">
                        <i class="fas fa-search mr-1"></i> Lost and Found
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url(session()->get('user_id') ? 'daftar_hewan/hilang' : 'login') ?>">
                            <i class="fas fa-heart-broken mr-2"></i> Hewan Dicari
                        </a>
                        <a class="dropdown-item" href="<?= base_url(session()->get('user_id') ? 'daftar_hewan/mencariPemilik' : 'login') ?>">
                            <i class="fas fa-home mr-2"></i> Mencari Pemilik
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="laporanDropdown" data-toggle="dropdown">
                        <i class="fas fa-file-alt mr-1"></i> Laporan
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?= base_url(session()->get('user_id') ? 'laporan/buat' : 'login') ?>">
                            <i class="fas fa-plus-circle mr-2"></i> Buat Laporan
                        </a>
                        <a class="dropdown-item" href="<?= base_url(session()->get('user_id') ? 'laporan' : 'login') ?>">
                            <i class="fas fa-history mr-2"></i> Riwayat Laporan
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link user-icon" href="<?= base_url(session()->get('user_id') ? 'profil' : 'login') ?>">
                        <i class="fas fa-user"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link help-button" href="<?= base_url('help') ?>">?</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    setTimeout(function() {
        let alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.transition = "opacity 1s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 1000);
        }
    }, 3000); // 3 seconds delay


    setTimeout(function () {
        let popup = document.getElementById('popup-thankyou');
        if (popup && popup.classList.contains('show')) {
            popup.classList.remove('show');
        }
    }, 5000); // 5 seconds before auto-hide

    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.querySelector('.toast-notification');
        const pet = document.querySelector('.toast-pet');
        
        if (toast) {
            setTimeout(() => {
                toast.classList.add('show');
                pet?.classList.add('show');
            }, 300);

            setTimeout(() => {
                toast.classList.remove('show');
                pet?.classList.remove('show');
            }, 5000);
        }
    });
</script>

</body>
</html>