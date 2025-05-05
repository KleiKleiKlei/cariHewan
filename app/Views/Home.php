<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<style>
    .hero-section {
        background: linear-gradient(135deg, #FFE5E5 0%, #FFF0F5 100%);
        border-radius: 20px;
        padding: 3rem 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .title-container {
        position: relative;
        margin-bottom: 2rem;
    }

    .main-title {
        color: #FF69B4;
        font-size: 2.5rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .subtitle {
        color: #666;
        text-align: center;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .pet-image-container {
        background: white;
        padding: 1rem;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }

    .pet-image-placeholder {
        width: 100%;
        height: 250px;
        background: linear-gradient(45deg, #FFB6C1, #FFC0CB);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .pet-icon {
        font-size: 4rem;
        color: white;
        animation: float 3s ease-in-out infinite;
    }

    .action-buttons .btn {
        padding: 1rem 1.5rem;
        border-radius: 50px;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-lost {
        background: #FF69B4;
        color: white;
    }

    .btn-lost:hover {
        background: #FF1493;
        transform: translateY(-3px);
        color: white;
    }

    .btn-found {
        background: #98FB98;
        color: #2E8B57;
    }

    .btn-found:hover {
        background: #90EE90;
        transform: translateY(-3px);
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    /* Easter Egg Styles */
    .secret-pet {
        position: fixed;
        bottom: -100px;
        font-size: 3rem;
        transition: all 0.5s ease;
        cursor: pointer;
        z-index: 1000;
        filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.2));
    }

    .secret-pet.show {
        bottom: 20px;
    }

    .secret-pet:hover {
        transform: scale(1.2) rotate(5deg);
    }

    .rainbow-text {
        background: linear-gradient(to right, 
            #ff69b4, #ff8e00, #ffff00, #00ff00, #00ffff, #0000ff, #ff69b4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: rainbow 5s linear infinite;
    }

    @keyframes rainbow {
        0% { background-position: 0% 50%; }
        100% { background-position: 200% 50%; }
    }

    .pet-rain {
        position: fixed;
        top: -50px;
        animation: fall linear forwards;
        z-index: 9999;
    }

    @keyframes fall {
        to { transform: translateY(110vh); }
    }

    .pet-showcase {
        position: relative;
        width: 300px;
        height: 300px;
        margin: 0 auto;
        cursor: pointer;
        perspective: 1000px;
    }

    .pet-carousel {
        position: relative;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transition: transform 0.8s ease-in-out;
    }

    .pet-image {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        border-radius: 20px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        opacity: 0;
        transition: opacity 0.5s ease-in-out, border-color 0.3s ease;
        filter: drop-shadow(0 5px 15px rgba(255, 105, 180, 0.3));
        border: 3px dashed #FFB6C1;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 15px;
        box-shadow: 
            0 0 0 3px #FFF,
            0 0 0 6px #FFE4E1,
            5px 5px 15px rgba(255, 105, 180, 0.2);
    }

    .pet-image.active {
        opacity: 1;
        border-color: #FF69B4;
        animation: borderDance 4s linear infinite;
    }

    @keyframes borderDance {
        0% { border-style: dashed; }
        25% { border-style: dotted; }
        50% { border-style: solid; }
        75% { border-style: dotted; }
        100% { border-style: dashed; }
    }

    .pet-showcase:hover .pet-image.active {
        border-color: #FF1493;
        border-width: 4px;
        transform: scale(1.02);
    }

    .loading-indicator {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #FF69B4;
        font-size: 2rem;
    }

    @keyframes fa-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="hero-section">
                <div class="title-container">
                    <h1 class="main-title">
                        <i class="fas fa-paw mr-2"></i>Cari Hewan
                    </h1>
                    <p class="subtitle">Mempertemukan kembali hewan kesayangan dengan pemiliknya</p>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="pet-showcase">
                            <div class="pet-carousel" id="petCarousel">
                                <div class="loading-indicator">
                                    <i class="fas fa-paw fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="action-buttons mt-4 mt-md-0">
                            <a href="<?= base_url('laporan/lost') ?>" class="btn btn-lost btn-block mb-3">
                                <i class="fas fa-search mr-2"></i>
                                Lapor Hewan Hilang
                            </a>
                            <a href="<?= base_url('laporan/ditemukan') ?>" class="btn btn-found btn-block">
                                <i class="fas fa-hand-holding-heart mr-2"></i>
                                Lapor Penemuan Hewan
                            </a>
                            <p class="text-center mt-3 text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Bantu kami menyatukan kembali hewan dengan pemiliknya
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="secretPet" class="secret-pet" style="left: 20px;">🐱</div>
    <div id="secretPet2" class="secret-pet" style="right: 20px;">🐶</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    const DOG_API_KEY = 'live_05cZ1Uysrc1nXyJ8IybxPjkHWyo7r92xwAavGqX973Prev2fhZHMYg9p0II8i52c';
    const CAT_API_KEY = 'live_qO6YS2aweg90DlSzplZdyBb585LX6NwbduN9LrymTN6JQIyNbPYEkMSQnqKAUYY1';
    
    const carousel = document.getElementById('petCarousel');

    async function fetchPetImages() {
        try {
            const [dogsResponse, catsResponse] = await Promise.all([
                // Increased limit to 4 for each API
                fetch('https://api.thedogapi.com/v1/images/search?size=med&limit=4', {
                    headers: { 'x-api-key': DOG_API_KEY }
                }),
                fetch('https://api.thecatapi.com/v1/images/search?size=med&limit=4', {
                    headers: { 'x-api-key': CAT_API_KEY }
                })
            ]);

            const dogs = await dogsResponse.json();
            const cats = await catsResponse.json();
            
            carousel.innerHTML = '';

            // Combine and shuffle 8 pets total
            const pets = [...dogs, ...cats]
                .sort(() => Math.random() - 0.5)
                // Filter out any non-suitable images (too large/small)
                .filter(pet => {
                    const ratio = pet.width / pet.height;
                    return ratio > 0.5 && ratio < 2; // Keep reasonably proportioned images
                })
                .slice(0, 8); // Keep maximum 8 images for smooth rotation
                
            pets.forEach((pet, index) => {
                const div = document.createElement('div');
                div.className = `pet-image${index === 0 ? ' active' : ''}`;
                // Add preloading for smoother transitions
                const img = new Image();
                img.src = pet.url;
                img.onload = () => {
                    div.style.backgroundImage = `url('${pet.url}')`;
                };
                carousel.appendChild(div);
            });

            startPetRotation();
        } catch (error) {
            console.error('Failed to fetch pet images:', error);
            // Fallback to static images
            const fallbackImages = [
                'https://i.imgur.com/8B4HhP9.png',
                'https://i.imgur.com/Q5M6JkN.png',
                'https://i.imgur.com/YHHHPDf.png',
                'https://i.imgur.com/2mX0WZZ.png'
            ];
            
            carousel.innerHTML = '';
            fallbackImages.forEach((url, index) => {
                const div = document.createElement('div');
                div.className = `pet-image${index === 0 ? ' active' : ''}`;
                div.style.backgroundImage = `url('${url}')`;
                carousel.appendChild(div);
            });
            
            startPetRotation();
        }
    }

    function startPetRotation() {
        const petImages = document.querySelectorAll('.pet-image');
        let currentIndex = 0;

        function rotatePets() {
            petImages[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % petImages.length;
            petImages[currentIndex].classList.add('active');
        }

        // Initial interval
        window.petInterval = setInterval(rotatePets, 3000);

        // Hover effects
        const petShowcase = document.querySelector('.pet-showcase');
        petShowcase.addEventListener('mouseenter', function() {
            clearInterval(window.petInterval);
            window.petInterval = setInterval(rotatePets, 1500);
        });

        petShowcase.addEventListener('mouseleave', function() {
            clearInterval(window.petInterval);
            window.petInterval = setInterval(rotatePets, 3000);
        });
    }

    // Initial load of pet images
    fetchPetImages();

    // Adjust refresh interval to be longer since we're fetching more images
    setInterval(fetchPetImages, 10 * 60 * 1000); // Refresh every 10 minutes

    // Konami Code
    const konamiCode = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a'];
    let konamiIndex = 0;

    // Pet counter for interaction
    let petCount = 0;
    const maxPets = 10;

    // Secret pets show up after scrolling
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            document.getElementById('secretPet').classList.add('show');
            document.getElementById('secretPet2').classList.add('show');
        }
    });

    // Pet interaction
    document.querySelectorAll('.secret-pet').forEach(pet => {
        pet.addEventListener('click', function() {
            petCount++;
            
            // Make pet bounce
            this.style.transform = 'translateY(-20px)';
            setTimeout(() => this.style.transform = '', 200);

            // Play cute meow/woof sound based on emoji
            const sound = new Audio(this.textContent === '🐱' ? 
                'https://www.myinstants.com/media/sounds/meow.mp3' : 
                'https://www.myinstants.com/media/sounds/puppybarking.mp3');
            sound.volume = 0.2;
            sound.play().catch(err => console.log('Audio failed to play:', err));

            // Easter egg when petting 10 times
            if (petCount === maxPets) {
                document.querySelector('.main-title').classList.add('rainbow-text');
                makeItRain();
            }
        });
    });

    // Konami code detection
    document.addEventListener('keydown', function(e) {
        if (e.key === konamiCode[konamiIndex]) {
            konamiIndex++;
            if (konamiIndex === konamiCode.length) {
                makeItRain();
                konamiIndex = 0;
            }
        } else {
            konamiIndex = 0;
        }
    });

    // Pet rain function
    function makeItRain() {
        const emojis = ['🐱', '🐶', '🐰', '🐹', '🦊', '🐼'];
        for (let i = 0; i < 50; i++) {
            setTimeout(() => {
                const emoji = emojis[Math.floor(Math.random() * emojis.length)];
                const left = Math.random() * window.innerWidth;
                const duration = Math.random() * 3 + 2;
                
                const pet = document.createElement('div');
                pet.className = 'pet-rain';
                pet.textContent = emoji;
                pet.style.left = left + 'px';
                pet.style.animationDuration = duration + 's';
                
                document.body.appendChild(pet);
                
                setTimeout(() => pet.remove(), duration * 1000);
            }, i * 100);
        }
    }
});
</script>
<?= $this->endSection() ?>