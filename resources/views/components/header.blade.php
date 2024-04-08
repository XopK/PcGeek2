<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between p-3 mb-4"
        style="box-shadow: 0px 4px 20.899999618530273px rgba(0, 0, 0, 0.25)">
        <div class="col-md-3 mb-2 mb-md-0">
            <a class="navbar-brand" href="#">PcGeek</a>
        </div>

        <div class="col-12 col-md-6 d-flex justify-content-center">
            <form class="position-relative w-100 mx-3" role="search">
                <input type="search" class="form-control search focus-ring focus-ring-secondary"
                    placeholder="Искать на PcGeek" aria-label="Search">
                <img src="image/search.svg" alt="Search" class="position-absolute search-icon">
            </form>
        </div>

        @auth
            <div class="d-flex align-items-center justify-content-end gap-4 col-md-3 text-end">
                <a class="links-user d-flex align-items-center" href="#"><img class="me-2" src="image/addplus.svg"
                        alt="ring">Создать</a>
                <a class="links-user" href="#"><img class="me-2" src="image/ring.svg" alt="ring"></a>
                <div class="dropdown">
                    <a class="links-user" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="me-2" src="image/profile.svg" alt="profile">
                    </a>
                    <ul class="dropdown-menu mt-5" aria-labelledby="dropdownMenuLink">
                        <li class="list-dropdown dropdown-item text-start" style="font-weight: 700">Привет, aniua_sserf</li>
                        <li class="list-dropdown text-start"><a class="dropdown-item" href="#"><img
                                    class="dropdown-image-exit" src="image/exit.svg" alt="exit">Выйти</a></li>
                        <li class="list-dropdown mb-3 text-start"><a class="dropdown-item" href="#"><img
                                    class="dropdown-image " src="image/settings.svg" alt="settings">Настройки</a></li>
                    </ul>

                </div>
            </div>
        @endauth
        @guest
            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-custom me-2">Войти</button>
            </div>
        @endguest
    </header>