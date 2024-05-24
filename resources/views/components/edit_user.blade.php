@if(Auth::user())
    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUser">Изменение личных данных</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/profile/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('error_edit'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error_edit') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" name="login_edit" value="{{Auth::user()->login}}"
                                   class="form-control focus-ring focus-ring-secondary border-secondary"
                                   id="login_edit">
                            @error('login_edit')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Почта</label>
                            <input type="email" name="email_edit" value="{{Auth::user()->email}}"
                                   class="form-control focus-ring focus-ring-secondary border-secondary"
                                   id="email_edit">
                            @error('email_edit')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="text" name="phone_edit" value="{{Auth::user()->phone}}"
                                   class="form-control focus-ring focus-ring-secondary border-secondary"
                                   id="phone_edit">
                            @error('phone_edit')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Фото профиля</label>
                            <input type="file" name="photo_edit"
                                   class="form-control focus-ring focus-ring-secondary border-secondary"
                                   id="photo" accept="image/*">
                            @error('photo_edit')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Подтвердите пароль</label>
                            <input type="password" name="confirm_password_edit"
                                   class="form-control focus-ring focus-ring-secondary border-secondary"
                                   id="confirm_password_edit">
                            @error('confirm_password_edit')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-custom mt-3">Изменить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
            type="text/javascript"></script>
    <script>
        $("#phone").mask("+7(999) 999-9999");
    </script>

    @if (session('error_edit') || $errors->has("login_edit") || $errors->has("email_edit")|| $errors->has("phone_edit")|| $errors->has("confirm_password_edit") || $errors->has("photo_edit") )
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const modal = new bootstrap.Modal(document.getElementById('editUser'));
                modal.show();
            });
        </script>
    @endif
@endif
