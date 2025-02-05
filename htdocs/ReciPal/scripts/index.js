import { appendAlert, loginButton, loggedInDOMUpdate } from "./modules/HTMLElems.js";

window.onload = function () {
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

                if (data.body.session) {
                    const session = data.body.session;

                    for (const uData in session) {
                        console.log(uData);
                        console.log(session[uData]);

                        if (typeof session[uData] === 'object' && session[uData] !== null)
                            session[uData] = JSON.stringify(session[uData]);

                        console.log(session[uData]);

                        sessionStorage.setItem(uData, session[uData]);
                    }

                    loggedInDOMUpdate(navbar);
                } else if (data.status === 201) {
                    
                }
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
}

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