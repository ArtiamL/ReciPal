import { appendAlert} from "./modules/HTMLElems.js";
import loggedInDOMUpdate from "./modules/elements/loggedInDOMUpdate.mjs";
import loginButton from "./modules/elements/loginButton.mjs";
import checkSession from "./modules/auth/checkSession.mjs";

window.addEventListener("DOMContentLoaded", async () => {
    // Login
    document.getElementById('viewPasswordButton').addEventListener('click', (e) => {
        console.log('clicked');
        showPassword(document.getElementById('password'), e.target);
    });

    // Sign Up
    const signUpPassInp = document.getElementById('signUpPassword');
    const confirmPassInp = document.getElementById('confirm');

    document.getElementById('signUpView').addEventListener('click', (e) => {
        console.log('clicked');
        showPassword(signUpPassInp, e.target);
    });

    document.getElementById('signUpConfirmView').addEventListener('click', (e) => {
        console.log('clicked');
        showPassword(confirmPassInp, e.target);
    });

    const tabElems = document.querySelectorAll('button[data-bs-toggle="tab"]');
    const submitButton = document.getElementById('modalBtn');

    tabElems.forEach((elem) => {
        elem.addEventListener('click', (e) => {

            if (submitButton) {
                if (e.target.getAttribute('data-bs-target') === '#signUpTab') {
                    submitButton.setAttribute('form', 'signUpForm');
                    submitButton.innerHTML = 'Sign Up';
                } else {
                    submitButton.setAttribute('form', 'loginForm')
                    submitButton.innerHTML = 'Login';
                }
            }
        });
    });


    confirmPassInp.addEventListener('input', (e) => {
        checkPassword(document.querySelector('#alertPlaceholderSignUp'), signUpPassInp.value, e.target.value, submitButton);
    });

    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false);
    });

    const navbar = document.querySelector('.navbar-nav #loginSection');

    document.body.addEventListener('submit', async event => {
        event.preventDefault();

        const form = event.target;

        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
        })
            .then(res => res.json().then(data => ({status: res.status, body: data})))
            .then(data => {
                console.log(data);
                appendAlert(document.querySelector('#' + form.id + ' #alertPlaceholder'), data.body.message, data.status);

                sessionStorage.setItem('username', data.body.username);

                loggedInDOMUpdate(navbar);
            })
            .catch(error => console.log(error));

    });

    // For changing login display on page load if session exists.
    const uname = sessionStorage.getItem('username')
    if (uname) {
        loggedInDOMUpdate(navbar);

    } else {
        loginButton(navbar);
    }
});

function showPassword(passwordElem, viewBtn) {
    viewBtn.classList.toggle("fa-eye");
    viewBtn.classList.toggle("fa-eye-slash");
    if (passwordElem.type === "password") {
        passwordElem.type = "text";
    } else {
        passwordElem.type = "password";
    }
}

function checkPassword(container, passInp, confirmInp, submitBtn) {
    if (passInp !== confirmInp) {
        appendAlert(container, 'Passwords do not match!')
        submitBtn.disabled = true;
    } else {
        container.innerHTML = '';
        submitBtn.removeAttribute('disabled');
    }
}