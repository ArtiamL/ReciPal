

// let showPost = function(response, isCurated) {
//     if (respose.readyState === 4 && response.status === 200){
//         if (isCurated) {
//             const container = document.getElementById("curated_posts");
//             // const template =
//             let curated = JSON.parse(response.responseText);
//             curated.forEach((element) => {
//
//             })
//         }
//
//     }
// }

// function parseTemplate(template, container) {
//     return fetch(template)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error("Failed to parse template");
//             }
//             return response.text();
//         })
//         .then(html => {
//             const templateContainer = document.createElement("div");
//             templateContainer.innerHTML = html;
//             const template = templateContainer.querySelector("#post_collapsed");
//             const elemContainer = container;
//         })
// }

// async function getCuratedPosts() {
//     const response = await fetch('./api/posts/curated/short');
//     return await response.json();
// }

document.onreadystatechange = function () {
    if (document.readyState === "complete") {
        // getCuratedPosts().then(r => console.log(r));



        // const post_collapsed = template.getElementById("post_collapsed");
        // const clone = post_collapsed.content.cloneNode(true);
        // clone.querySelector(".post_heading").innerHTML = "Hello, world!";
        // container.appendChild(post_collapsed);
    }
}

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

    const myCarouselElement = document.querySelector('#foodCarousel')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
        interval: 2000,
        touch: false
    })

}

function appendAlert(container, message, type) {
    container.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible d-flex align-items-center" role="alert">
            <div>${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`
    ].join('')
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
        appendAlert(container, 'Passwords do not match!', 'danger')
        submitBtn.disabled = true;
    } else {
        container.innerHTML = '';
        submitBtn.removeAttribute('disabled');
    }

}