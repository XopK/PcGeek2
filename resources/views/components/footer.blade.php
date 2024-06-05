<footer class="pt-5">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            <h5>Главное</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="/" class="nav-link p-0 text-body-secondary">Главная</a></li>
                @auth
                    <li class="nav-item mb-2"><a href="/profile" class="nav-link p-0 text-body-secondary">Личный кабинет</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item mb-2"><button type="button" data-bs-toggle="modal" data-bs-target="#signIn"
                            class="nav-link p-0 text-body-secondary">Личный кабинет</button></li>
                @endguest
            </ul>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <h5>Следите за нами</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="https://vk.com/" class="nav-link p-0 text-body-secondary">VK</a></li>
                <li class="nav-item mb-2"><a href="https://web.telegram.org/a/" class="nav-link p-0 text-body-secondary">Telegram</a></li>
                <li class="nav-item mb-2"><a href="https://www.youtube.com/" class="nav-link p-0 text-body-secondary">YouTube</a></li>
                <li class="nav-item mb-2"><a href="https://web.whatsapp.com/" class="nav-link p-0 text-body-secondary">WhatsApp</a></li>
            </ul>
        </div>
    </div>
    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
        <p>© 2024 PcGeek</p>
    </div>
</footer>
