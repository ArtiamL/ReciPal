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

    <title>ReciPal</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ReciPal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./categories.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./categories.php">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./categories.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./categories.php">About</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
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
</body>
</html>