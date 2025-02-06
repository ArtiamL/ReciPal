export default function detailsForm(container) {
    return container.innerHTML = [
        `<form method="post" action="./api/update" id="userDetailsForm" autocomplete="on">
            <div id="alertPlaceholder" class="mb-3"></div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" aria-required="true">
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="username" aria-describedby="" autocomplete="off" aria-required="true">
            </div>
            <div class="mb-3">
                <label for="signUpPassword" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control passwordInp" id="signUpPassword" pattern="^((?=\\S*?[A-Z])(?=\\S*?[a-z])(?=\\S*?[0-9]).{6,})\\S$" title="Password must contain a minimum of 8 characters, at least one: uppercase letter, lowercase letter, number and special character" aria-required="true" required>
                    <button class="btn btn-outline-secondary fa-solid fa-eye" type="button" id="signUpView"></button>
                </div>
                <div class="invalid-feedback">Please enter a Password.</div>
            </div>
            <div class="mb-3">
                <label for="confirm" class="form-label">Confirm Password</label>
                <div class="input-group mb-3">
                    <input name="confirm" type="password" class="form-control passwordInp" id="confirm" aria-required="true" required>
                    <button class="btn btn-outline-secondary fa-solid fa-eye" type="button" id="signUpConfirmView"></button>
                </div>
                <div class="invalid-feedback">Please confim password.</div>
            </div>
            <div id="alertPlaceholderSignUp" class="mb-3"></div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>`
    ];
}