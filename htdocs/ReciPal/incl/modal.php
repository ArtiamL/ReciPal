<div class="modal fade" tabindex="-1" id="loginModal" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs w-100 border-bottom-0" role="tablist" id="tabs">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#loginTab" type="button">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#signUpTab" type="button">Sign Up</button>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="loginTab">
                        <div id="alertPlaceholderInvalid" class="mb-3"></div>
                        <form method="post" action="./api/login" id="loginForm" class="needs-validation" autocomplete="on" novalidate>
                            <div class="mb-3">
<!--                                TODO: Change to allow username as well as email.-->
                                <label for="email" class="form-label">Email address</label>
                                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" aria-required="true" required>
                                <div class="invalid-feedback">Please enter an Email address.</div>
                            </div>
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group mb-3">
                                <input name="password" type="password" class="form-control" id="password" aria-required="true" required>
                                <button class="btn btn-outline-secondary fa-solid fa-eye" type="button" id="viewPasswordButton"></button>
                                <div class="invalid-feedback">Please enter a Password.</div>
                            </div>
                        </form>
                    </div>

                    <!-- Sign Up Tab -->
                    <div class="tab-pane fade" id="signUpTab">
                        <div id="alertPlaceholderInvalid" class="mb-3"></div>
                        <form method="post" action="./api/register" id="signUpForm" class="needs-validation" autocomplete="on" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" aria-required="true" required>
                                <div class="invalid-feedback">Please enter an Email address.</div>
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input name="username" type="text" class="form-control" id="username" aria-describedby="" autocomplete="off" aria-required="true" required>
                                <div class="invalid-feedback">Please enter a Username.</div>
                            </div>
                            <div class="mb-3">
                                <label for="signUpPassword" class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input name="password" type="password" class="form-control passwordInp" id="signUpPassword" pattern="^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$" title="Password must contain a minimum of 8 characters, at least one: uppercase letter, lowercase letter, number and special character" aria-required="true" required>
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
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="loginForm" id="modalBtn">Login</button>
            </div>
        </div>
    </div>
</div>