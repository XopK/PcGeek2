<div class="modal fade" id="signIn" tabindex="-1" aria-labelledby="signIn" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signIn">Авторизация</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/signIn" method="POST">
                    @csrf
                    @if (session('error_signIn'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error_signIn') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="login">Логин</label>
                        <input type="text" name="login_signIn"
                            class="form-control focus-ring focus-ring-secondary border-secondary" id="login"
                            placeholder="Введите логин" value="{{ old('login_signIn') }}">
                        @error('login_signIn')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Пароль</label>
                        <input type="password" name="password_signIn"
                            class="form-control focus-ring focus-ring-secondary border-secondary" id="password"
                            placeholder="Введите пароль">
                        @error('password_signIn')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Авторизация</button>
                    </div>
                    <div class="text-center mt-3">
                        <p><a href="#" data-bs-target="#signUp" data-bs-toggle="modal"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Регистрация</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="signUp" aria-hidden="true" aria-labelledby="signUp" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signUp">Регистрация</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/signUp" method="POST">
                    @csrf
                    @if (session('error_signUp'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error_signUp') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="login">Логин</label>
                        <input type="text" name="login"
                            class="form-control focus-ring focus-ring-secondary border-secondary" id="login"
                            placeholder="Введите логин" value="{{ old('login') }}">
                        @error('login')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Почта</label>
                        <input type="email" name="email"
                            class="form-control focus-ring focus-ring-secondary border-secondary" id="email"
                            placeholder="Введите email" value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone_number">Номер телефона</label>
                        <input type="text" name="phone"
                            class="form-control focus-ring focus-ring-secondary border-secondary" id="phone_number"
                            placeholder="+7(___) ___-____" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Пароль</label>
                        <input type="password" name="password"
                            class="form-control focus-ring focus-ring-secondary border-secondary" id="password"
                            placeholder="Пароль минимум 8 символов">
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="confirm_password">Подтверждение пароля</label>
                        <input type="password" name="confirm_password"
                            class="form-control focus-ring focus-ring-secondary border-secondary"
                            id="confirm_password" placeholder="Введите пароль снова">
                        @error('confirm_password')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-custom">Регистрация</button>
                    </div>
                    <div class="text-center mt-3">
                        <p><a href="" data-bs-toggle="modal" data-bs-target="#signIn"
                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Авторизация</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
    type="text/javascript"></script>
<script>
    $("#phone_number").mask("+7(999) 999-9999");
</script>
@if (session('error_signIn'))
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = new bootstrap.Modal(document.getElementById('signIn'));
            modal.show();
        });
    </script>
@endif
@if (session('error_signUp'))
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = new bootstrap.Modal(document.getElementById('signUp'));
            modal.show();
        });
    </script>
@endif
@if ($errors->has('login_signIn')||$errors->has('password_signIn'))
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = new bootstrap.Modal(document.getElementById('signIn'));
            modal.show();
        });
    </script>
@endif
@if ($errors->has('login')||$errors->has('email')||$errors->has('phone')||$errors->has('password')||$errors->has('confirm_password'))
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = new bootstrap.Modal(document.getElementById('signUp'));
            modal.show();
        });
    </script>
@endif
