<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Categories</title>
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
            <h2 class="text-center mb-4">Recipe Categories</h2>

            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search Recipes...">
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-auto">
                    <a href="#" class="category-link btn btn-primary" onclick="showCategory('mainCourse')">Main Course</a>
                </div>
                <div class="col-auto">
                    <a href="#" class="category-link btn btn-primary" onclick="showCategory('dessert')">Dessert</a>
                </div>
                <div class="col-auto">
                    <a href="#" class="category-link btn btn-primary" onclick="showCategory('vegan')">Vegan / Gluten-Free</a>
                </div>
            </div>

            <div id="mainCourse" class="recipe-category">
                <h4>Main Course Recipes</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card recipe-card">
                            <img src="img/biryani.jpg" class="card-img-top" alt="Biryani">
                            <div class="card-body">
                                <h5 class="card-title">Biryani</h5>
                                <p class="card-text">A fragrant rice dish with marinated meat and spices.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dessert" class="recipe-category">
                <h4>Dessert Recipes</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card recipe-card">
                            <img src="../img/chocolate-cake.jpg" class="card-img-top" alt="Chocolate Cake">
                            <div class="card-body">
                                <h5 class="card-title">Chocolate Cake</h5>
                                <p class="card-text">A rich, moist cake made with the finest cocoa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="vegan" class="recipe-category">
                <h4>Vegan / Gluten-Free Recipes</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card recipe-card">
                            <img src="../img/vegan-salad.jpg" class="card-img-top" alt="Vegan Salad">
                            <div class="card-body">
                                <h5 class="card-title">Vegan Salad</h5>
                                <p class="card-text">A healthy salad with fresh veggies and a light dressing.</p>
                            </div>
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
    <script type="module" src="scripts/index.js" defer></script>

    <script>
        function showCategory(category) {
            document.querySelectorAll('.recipe-category').forEach(function (categoryDiv) {
                categoryDiv.classList.remove('active');
            });
            document.getElementById(category).classList.add('active');
        }

        document.getElementById('searchInput').addEventListener('keyup', function() {
            var query = this.value.toLowerCase();
            var cards = document.querySelectorAll('.recipe-card');

            cards.forEach(function(card) {
                var title = card.querySelector('.card-title').textContent.toLowerCase();
                if (title.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

</body>
</html>
