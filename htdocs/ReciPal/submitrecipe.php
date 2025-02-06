<?php session_start(); error_log(var_export($_SESSION, true))?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">

    <script src="https://kit.fontawesome.com/7f67cc5608.js" crossorigin="anonymous" defer></script>
</head>
<body>
    <header>
        <?php include_once './incl/navbar.php' ?>

<!--        <script type="module">-->
<!--            import loginButton from './scripts/modules/elements/loginButton.mjs';-->
<!---->
<!--            const loginSection = document.getElementById('loginSection');-->
<!---->
<!--            // loginModal(header);-->
<!--            loginButton(loginSection);-->
<!--        </script>-->
    </header>

    <main>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Submit Your Recipe</h2>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm p-4" id="recipeSubmitContainer">

                    </div>
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
