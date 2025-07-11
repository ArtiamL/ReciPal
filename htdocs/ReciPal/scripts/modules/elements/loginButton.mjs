import submitForm from "./submitForm.mjs";

export default function loginButton(container, formContainer) {
    if (formContainer) {
        formContainer.innerHTML = `<h3>Please Login</h3>`;
    }

    return container.innerHTML = [
        // `<li class="nav-item">
        `<button type="button" class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fa-solid fa-user"></i> Login/Sign Up
        </button>`
        // </li>`

    ].join('');
}