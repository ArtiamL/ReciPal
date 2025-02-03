<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ReciPal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
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
            <?php if (!isset($_SESSION['username'])): ?>
                <button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fa-solid fa-user"></i> Login/Sign Up
                </button>
            <?php else: ?>
                <div class="dropdown">
                  <button class="btn btn-light me-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i> <?php echo $_SESSION['username'] ?>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="./api/logout" method="POST">
                            <button type="submit" class="dropdown-item"><i class="fa-solid fa-power-off"></i> Logout</button>
                        </form>
                    </li>
                  </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>