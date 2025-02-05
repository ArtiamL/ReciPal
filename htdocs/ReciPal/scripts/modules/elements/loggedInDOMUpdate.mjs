import loginButton from "./loginButton.mjs";
export default function loggedInDOMUpdate(container) {
    const html = container.innerHTML = [
        `<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i> ${sessionStorage.getItem('username')}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./user_profile.php" id="profileLink"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li><a class="dropdown-item" href="./user_settings.php" id="settingsLink"><i class="fa-solid fa-gear"></i> Settings</a></li>
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