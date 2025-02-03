<nav class="navbar navbar-expand-lg bg-body-tertiary">
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
                <?php if (!isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fa-solid fa-user"></i> Login/Sign Up
                        </button>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> <?php echo $_SESSION['username'] ?>
                      </a>
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
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>