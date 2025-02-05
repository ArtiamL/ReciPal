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

        <script type="module">
            import loginButton from './scripts/modules/elements/loginButton.mjs';

            const loginSection = document.getElementById('loginSection');

            // loginModal(header);
            loginButton(loginSection);
        </script>
    </header>

    <main>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Submit Your Recipe</h2>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm p-4" id="recipeSubmitContainer">
                        <script type="module">
                            import submitForm from "./scripts/modules/elements/submitForm.mjs";
                            import checkSession from "./scripts/modules/auth/checkSession.mjs";

                            const container = document.getElementById("recipeSubmitContainer");

                            const session = await checkSession();//.then(res => console.log(res));

                            console.log(session);

                            if (session)
                                submitForm(document.getElementById("recipeSubmitContainer"));
                            // } else {
                            //     document.getElementById("recipeSubmitContainer").innerHTML = `<h3>Please Login</h3>`;
                            // }
                        </script>
<!--                        --><?php //if(isset($_SESSION['user_uuid'])): ?>
<!--                            <form action="submit_recipe.php" method="POST" enctype="multipart/form-data" id="recipeSubmitForm">-->
<!--                                <div class="mb-3">-->
<!--                                    <label for="recipeName" class="form-label">Recipe Name</label>-->
<!--                                    <input type="text" class="form-control" id="recipeName" name="recipeName" placeholder="Enter recipe name" required>-->
<!--                                </div>-->
<!---->
<!--                                <div class="mb-3">-->
<!--                                    <label for="recipeImage" class="form-label">Upload Recipe Image</label>-->
<!--                                    <input type="file" class="form-control" id="recipeImage" name="recipeImage" required>-->
<!--                                </div>-->
<!--                                <div class="mb-3">-->
<!--                                    <label for="recipeDescription" class="form-label">Recipe Description</label>-->
<!--                                    <textarea class="form-control" id="recipeDescription" name="recipeDescription" rows="4" placeholder="Write a short description of your recipe" required></textarea>-->
<!--                                </div>-->
<!--                                <button type="submit" class="btn btn-success w-100">Submit Recipe</button>-->
<!--                            </form>-->
<!--                        --><?php //else: ?>
<!--                            <h3 class="text-center mb-4">Please Login</h3>-->
<!--                            --><?php //include_once './incl/loginForm.php' ?>
<!--                            <div class="text-center mb-4">-->
<!--                                <button type="submit" class="btn btn-primary" form="loginForm" id="modalBtn">Login</button>-->
<!--                            </div>-->
<!--                        --><?php //endif; ?>
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
