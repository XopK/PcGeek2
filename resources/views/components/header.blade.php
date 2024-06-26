<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between p-3 mb-4"
        style="box-shadow: 0px 4px 20.899999618530273px rgba(0, 0, 0, 0.25)">
    <div class="col-md-3 mb-2 mb-md-0">
        <a class="navbar-brand" href="/">PcGeek</a>
    </div>

    <div class="col-12 col-md-6 d-flex justify-content-center">
        <form class="position-relative w-100 mx-3" action="/" method="GET" role="search">
            <input type="search" name="search" class="form-control search focus-ring focus-ring-secondary"
                   placeholder="Искать на PcGeek" value="{{ request('search') }}" aria-label="Search">
            <img src="/image/search.svg" alt="Search" class="position-absolute search-icon">
        </form>
    </div>

    @auth
        <div class="d-flex align-items-center justify-content-end gap-4 col-md-3 text-end">
            <a class="links-user d-flex align-items-center" href="/addPost"><img class="me-2" src="/image/addplus.svg"
                                                                                 alt="ring">Создать</a>
            {{--<a class="links-user" href="#"><img class="me-2" src="/image/ring.svg" alt="ring"></a>--}}
            <div class="dropdown">
                <a class="links-user" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <img class="me-2 profile-img-forum" src="/storage/users_profile/{{Auth::user()->profile_img}}"
                         alt="profile">
                </a>
                <ul class="dropdown-menu mt-5" aria-labelledby="dropdownMenuLink">
                    <li class="list-dropdown dropdown-item text-start" style="font-weight: 700"><a
                            class="dropdown-item p-0"
                            href="/profile">Привет, {{ Auth::user()->login }}</a></li>
                    <li class="list-dropdown text-start"><a class="dropdown-item" href="/logout"><img
                                class="dropdown-image-exit" src="/image/exit.svg" alt="exit">Выйти</a></li>
                    @if(Auth::user()->id_role == 3)
                        <li class="list-dropdown text-start"><a class="dropdown-item" href="/moderator"><img
                                    class="dropdown-image-exit" src="/image/shield.svg" alt="shield">Панель
                                модератора</a></li>
                    @endif
                    <li class="list-dropdown mb-3 text-start"><a class="dropdown-item" data-bs-toggle="modal"
                                                                 data-bs-target="#editUser"><img
                                class="dropdown-image " src="/image/settings.svg" alt="settings">Настройки</a></li>
                </ul>

            </div>
        </div>
    @endauth
    @guest

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-custom me-2" data-bs-toggle="modal"
                    data-bs-target="#signIn">Войти
            </button>
        </div>

    @endguest
</header>
