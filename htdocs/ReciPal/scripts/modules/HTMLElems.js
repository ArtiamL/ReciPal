export function appendAlert(code, container, message) {
    let alertType;

    switch (code) {
        case 200:
        case 201:
            alertType = 'success';
            break;
        // const redirect = (location.reload(), 5000) => await new Promise(resolve => setTimeout(resolve, 5000));
        case 400:
        case 500:
            alertType = 'danger';
            break;
        case 409:
            alertType = 'warning';
            break;
    }

    return container.innerHTML = [
        `<div class="alert alert-${alertType} alert-dismissible d-flex align-items-center" role="alert">
            <div>${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
    ].join('')
}

export function loginButton(container) {
    return container.innerHTML = [
        `<li class="nav-item">
            <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fa-solid fa-user"></i> Login/Sign Up
            </button>
        </li>`
    ].join('')
}

export function loggedInDropdown(container) {
    return container.innerHTML = [
        `<li class="nav-item dropdown">
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
        </li>`
    ].join('')
}