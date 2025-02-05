<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">

    <script src="https://kit.fontawesome.com/7f67cc5608.js" crossorigin="anonymous" defer></script>
</head>
<body>
    <header>
        <?php include_once './incl/navbar.php' ?>

        <script type="module">
            import loginButton from './scripts/modules/elements/loginButton.mjs';

            const loginSection = document.getElementById('loginSection');

            // loginModal(header);
            loginButton(loginSection);
        </script>
    </header>

    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="img/aboutrecipe.png" alt="Company Image" class="company-image">
                </div>

                <div class="col-md-6">
                    <h2>About Our Company</h2>
                    <p>
                        Welcome to ReciPal, the leading recipe sharing provider. We are passionate about delivering exceptional services and products that cater to the needs of our diverse clientele. With a commitment to quality, innovation, and customer satisfaction, we have established ourselves as a trusted name in the industry.
                    </p>
                    <p>
                        Our team consists of experienced professionals who strive for excellence in everything they do. We are dedicated to providing solutions that make a real difference and create lasting value for our clients.
                    </p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>Our Goals</h3>
                    <ul class="goal-list">
                        <li>To provide innovative solutions that meet the evolving needs of our clients.</li>
                        <li>To maintain the highest standards of quality and integrity in all our operations.</li>
                        <li>To create an environment of growth and development for our employees.</li>
                        <li>To contribute positively to the communities we serve.</li>
                        <li>To build long-term relationships with clients based on trust and mutual respect.</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php include_once './incl/modal.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script type="module" src="scripts/index.js" defer></script>
</body>
</html>
