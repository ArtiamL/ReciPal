<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            <div class="contact-container">
                <h2 class="text-center mb-4">Contact Us</h2>

                <div class="card p-4 shadow-lg">
                    <h4 class="text-center mb-3">Get in Touch</h4>
                    <form action="contact_submit.php" method="POST">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message here..." required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
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
