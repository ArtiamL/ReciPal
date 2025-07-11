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

    <title>ReciPal | User Settings</title>
</head>
<body>
<header>
    <?php include_once './incl/navbar.php' ?>
</header>

<main>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Details</h2>

        <div class="row justify-content-center" id="uDetailsCntr">
            <div class="col-md-8">
                <div class="card shadow-sm p-4" id="recipeSubmitContainer">

                </div>
            </div>
        </div>
    </div>
</main>

<!--<script type="module">-->
<!--    import checkSession from "./scripts/modules/auth/checkSession.mjs";-->
<!--    import detailsForm from "./scripts/modules/elements/detailsForm.mjs";-->
<!---->
<!--    const container = document.getElementById("uDetailsCntr");-->
<!---->
<!--    const session = await checkSession();//.then(res => console.log(res));-->
<!---->
<!--    console.log(session);-->
<!---->
<!--    if (session)-->
<!--        detailsForm(document.getElementById("uDetailsCntr"));-->
<!--</script>-->

<?php include_once './incl/modal.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script type="module" src="./scripts/index.js" defer></script>
</body>
</html>