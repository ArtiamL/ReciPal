import { appendAlert} from "./modules/HTMLElems.js";
import loggedInDOMUpdate from "./modules/elements/loggedInDOMUpdate.mjs";
import loginButton from "./modules/elements/loginButton.mjs";
import checkSession from "./modules/auth/checkSession.mjs";
import submitForm from "./modules/elements/submitForm.mjs";
import detailsForm from "./modules/elements/detailsForm.mjs";

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
        checkPassword(document.getElementById('alertPlaceholderSignUp'), signUpPassInp.value, e.target.value, submitButton);
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

    const navbar = document.getElementById('loginSection');

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

                if (data.status === 200) {
                    sessionStorage.setItem('username', data.body.username);
                    sessionStorage.setItem('user_uuid', data.body.user_uuid);

                    if (recipeSubmitContainer)
                        loggedInDOMUpdate(navbar, recipeSubmitContainer);
                }

            })
            .catch(error => console.log(error));

    });

    // For changing login display on page load if session exists.
    const uname = sessionStorage.getItem('username');

    let cntr;

    if (document.getElementById('recipeSubmitContainer'))
        cntr = document.getElementById('recipeSubmitContainer');
    else if (document.getElementById('uDetailsCntr'))
        cntr = document.getElementById('uDetailsCntr');

    console.log(cntr);

    if (!uname) {
        loginButton(navbar, cntr);
    } else {
        loggedInDOMUpdate(navbar, cntr);
        submitForm(cntr);
        detailsForm(cntr);
    }

    const myCarouselElement = document.querySelector('#foodCarousel');

    if (myCarouselElement) {
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 2000,
            touch: false
        });
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