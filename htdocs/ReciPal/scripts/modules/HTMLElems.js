

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

export function userProfile() {
    if (sessionStorage.getItem('username')) {
        // return profile
    }
}

export function userSettings() {
    if (!sessionStorage.getItem('username')) {
        return document.body.innerHTML = [

        ];
    }
}