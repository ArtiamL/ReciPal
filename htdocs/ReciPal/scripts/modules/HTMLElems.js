export function appendAlert(container, message, code = null) {
    let alertType;

    switch (code) {
        case 200:
        case 201:
            alertType = 'success';
            break;
        // const redirect = (location.reload(), 5000) => await new Promise(resolve => setTimeout(resolve, 5000));
        case 409:
            alertType = 'warning';
            break;
        case 400:
        case 500:
        default:
            alertType = 'danger';
            break;
    }

    return container.innerHTML = [
        `<div class="alert alert-${alertType} alert-dismissible d-flex align-items-center fade show" role="alert" id="loginSignUpAlert">
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

export function loggedInDOMUpdate(container) {
    const html = container.innerHTML = [
        `<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i> ${sessionStorage.getItem('username')}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" id="profileLink"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#" id="settingsLink"><i class="fa-solid fa-gear"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><button type="submit" class="dropdown-item" id="logoutButton"><i class="fa-solid fa-power-off"></i> Logout</button></li>
            </ul>
        </li>`
    ].join('');

    const logoutButton = document.getElementById('logoutButton');

    logoutButton.addEventListener('click', (e) => {
        sessionStorage.clear();
        loginButton(container);
    });

    const alert = bootstrap.Alert.getOrCreateInstance('#loginSignUpAlert');
    const modal = bootstrap.Modal.getOrCreateInstance('#loginModal');

    setTimeout(() => {alert.close(); modal.hide()}, 1000);

    return {html, logoutButton};
}