<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 p-3"
     style="box-shadow: 0px 4px 20.899999618530273px rgba(0, 0, 0, 0.25)">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin">PcGeek</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Пользователи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/moderator">Модераторы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/parser">Парсер</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Компоненты
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/components">Все компоненты</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=7">Процессор</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=6">Видеокарта</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=5">Блок питания</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=4">SSD</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=3">Оперативная память</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=2">Жесткий диск</a></li>
                        <li><a class="dropdown-item" href="/admin/components?type=1">Материнская плата</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Выход</a>
                </li>
            </ul>
            {{--<form class="d-flex" role="search">
                <input class="form-control focus-ring focus-ring-secondary border-secondary me-2" type="search"
                       placeholder="Поиск" aria-label="Search">
                <button class="btn btn-custom" type="submit">Искать</button>
            </form>--}}
        </div>
    </div>
</nav>
