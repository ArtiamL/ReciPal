<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,500;1,600&family=IBM+Plex+Sans:wght@500&display=swap"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="./styles/styles.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/7f67cc5608.js" crossorigin="anonymous" defer></script>

    <title>ReciPal</title>
</head>
<body>
<header>
    <?php include_once './incl/menu.php' ?>

    <script type="module">
        import loginButton from './scripts/modules/elements/loginButton.mjs';

        const loginSection = document.getElementById('loginSection');

        // loginModal(header);
        loginButton(loginSection);
    </script>
</header>

<main>
    <div id="foodCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/recipebanner1.jpg" class="d-block w-100" alt="Biryani">
            </div>
            <div class="carousel-item">
                <img src="img/recipebanner2.webp" class="d-block w-100" alt="Chickpea Curry">
            </div>
            <div class="carousel-item">
                <img src="./img/recipe3.webp" class="d-block w-100" alt="Chicken Tikka Masala">
            </div>
            <div class="carousel-item">
                <img src="./img/recipe4.avif" class="d-block w-100" alt="Chicken Pie">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#foodCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#foodCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    <h1 class="text-center mt-4">Our Favourite Recipes</h1>
    <div class="container mt-4">
        <div class="row">
            <?php for ?>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="./img/biryani.jpg" class="card-img-top" alt="Biryani">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Biryani</strong> – A fragrant and flavorful rice dish made with marinated meat, aromatic spices, and basmati rice, slow-cooked to perfection.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="./img/chichpeacurry.jpg" class="card-img-top" alt="Chickpea Curry">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Chickpea Curry (Chana Masala)</strong> – A hearty dish featuring chickpeas in a rich tomato-based gravy with warm spices. Best with rice or naan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="./img/chicken-tikka-masala-73901-2.jpeg" class="card-img-top" alt="Chicken Tikka Masala">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Chicken Tikka Masala</strong> – Succulent grilled chicken chunks in a creamy tomato and butter sauce, packed with bold Indian flavors.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="./img/chickenpie.avif" class="card-img-top" alt="Chicken Pie">
                    <div class="card-body">
                        <p class="card-text">
                            <strong>Chicken Pie</strong> – A classic comfort food with a flaky, buttery crust filled with tender chicken, vegetables, and a creamy sauce.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once './incl/modal.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script type="module" src="./scripts/index.js" defer></script>
</body>
</html>