<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>PcGeek</title>
</head>

<body>
    <x-header></x-header>
    <div class="container">
        <div class="header-forum-page d-flex gap-2 mt-4">
            <div class="back-page">
                <a href="/" class="btn btn-custom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8">
                        </path>
                    </svg>
                    Назад
                </a>
            </div>
            <img src="/image/profile.svg" class="profile-img-forum" alt="profile.svg">
            <div class="author-post">
                <p class="fw-medium m-0">danya123</p>
                <p class="fw-light m-0">5 минут назад</p>
            </div>
        </div>
        <div class="forum-page-post mt-2">
            <h1>Название поста</h1>
            <div class="tags mb-3">
                <span class="badge fw-bold text-bg-custom">Процессор</span>
            </div>
            <div class="col-md-10">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text fw-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                            suscipit, voluptate ab tenetur laborum modi exercitationem voluptatibus ratione vitae maxime
                            a hic eius mollitia officia, nostrum ipsa ipsam aut praesentium.</p>
                        <img src="/image/test/pc.jpg" class="card-img-top forum-page-img" alt="pc.jpg">
                        <div class="d-flex gap-3">
                            <div class="d-flex justify-content-between mx-0 mt-3">
                                <div class="like-dislike-buttons d-flex align-items-center">
                                    <button type="button" class="btn btn-like"><img src="/image/up_arrow.svg"
                                            alt="up_arrow"></button>
                                    <span class="likes-count text-white mx-2">50</span>
                                    <button type="button" class="btn btn-dislike"><img src="/image/down_arrow.svg"
                                            alt="down_arrow"></button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                    <button type="button" class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                            alt="comment"></button>
                                    <span class="comments-count text-white ml-2 mx-2">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-section mt-4">
            <h2>Комментарии</h2>
            <hr>
            <div class="add-comment d-flex gap-2 mt-2">
                <img src="/image/profile.svg" class="profile-img-forum" alt="profile.svg">
                <form class="d-flex align-items-center gap-2 w-100">
                    <input class="form-control" placeholder="Напишите комментарий здесь...">
                    <button type="submit" class="btn btn-custom">Отправить</button>
                </form>
            </div>
            <div class="comments mt-4">
                <div class="comment d-flex gap-2 mb-3">
                    <img src="/image/profile.svg" class="profile-img-forum" alt="profile.svg">
                    <div class="comment-content">
                        <div class="author-comment d-flex justify-content-between">
                            <div class="author-info d-flex gap-2">
                                <p class="fw-medium m-0">danya123</p>
                                <p class="fw-light m-0">5 minutes ago</p>
                            </div>
                        </div>
                        <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec
                            odio. Praesent libero.</p>
                        <button type="button"
                            class="reply-btn link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ответить</button>
                        <div class="reply-form d-none mt-2">
                            <form class="d-flex align-items-center gap-2 w-100">
                                <input class="form-control" placeholder="Напишите ответ здесь...">
                                <button type="submit" class="btn btn-custom">Отправить</button>
                            </form>
                        </div>
                        <div class="replies mt-3">
                            <div class="reply d-flex gap-2">
                                <img src="/image/profile.svg" class="profile-img-forum" alt="profile.svg">
                                <div class="reply-content">
                                    <div class="author-reply d-flex justify-content-between">
                                        <div class="author-info d-flex gap-2">
                                            <p class="fw-medium m-0">user456</p>
                                            <p class="fw-light m-0">3 minutes ago</p>
                                        </div>
                                    </div>
                                    <p class="reply-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Integer nec odio. Praesent libero.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment d-flex gap-2 mb-3">
                    <img src="/image/profile.svg" class="profile-img-forum" alt="profile.svg">
                    <div class="comment-content">
                        <div class="author-comment d-flex justify-content-between">
                            <div class="author-info d-flex gap-2">
                                <p class="fw-medium m-0">user789</p>
                                <p class="fw-light m-0">10 minutes ago</p>
                            </div>
                        </div>
                        <p class="comment-text">Sed sagittis, quam vitae lacinia tincidunt, velit eros ullamcorper
                            tellus, eget aliquam nisl velit at nisl.</p>
                        <button type="button"
                            class="reply-btn link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ответить</button>
                        <div class="reply-form d-none mt-2">
                            <form class="d-flex align-items-center gap-2 w-100">
                                <input class="form-control" placeholder="Напишите ответ здесь...">
                                <button type="submit" class="btn btn-custom">Отправить</button>
                            </form>
                        </div>
                        <div class="replies mt-3">
                            <!-- Repeat this structure for each reply -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    <script>
        const replyBtns = document.querySelectorAll('.reply-btn');

        replyBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const replyForm = btn.parentNode.querySelector('.reply-form');
                replyForm.classList.toggle('d-none');
            });
        });
    </script>
</body>

</html>
