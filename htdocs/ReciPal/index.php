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


    <script src="https://kit.fontawesome.com/7f67cc5608.js" crossorigin="anonymous" defer></script>

    <script type="module" src="./scripts/index.js" defer></script>

    <title>ReciPal</title>
</head>
<body>
<header>
    <?php include_once './incl/menu.php' ?>
</header>

<main>
    <h1>ReciPal</h1>
    <section id="curated_posts">
        <h2>We Love these Recipes!</h2>
        <?php //loop through curated posts ?>
        <div class="recipe_posts"></div>
    </section>
    <section id="newest_posts">
        <h2>Newest Recipes</h2>
        <!--            <hr>-->
        <div class="recipe_posts"></div>
    </section>
</main>


<?php include_once './incl/modal.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>