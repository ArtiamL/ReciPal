export default function loginButton(container) {
    return container.innerHTML = [
        // `<li class="nav-item">
        `<button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fa-solid fa-user"></i> Login/Sign Up
        </button>`
        // </li>`
    ].join('')
}