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
    <title>PcGeek</title>
</head>

<body>
    <x-header></x-header>
    <div class="container">
        <div class="profile-header d-flex mt-4  ">
            <img src="/image/profile.svg" class="profile-img" alt="profile.svg">
            <div class="login-user-edit mx-3">
                <p class="mb-0 fs-1 fw-bold p-0">{{ Auth::user()->login }}</p>
                <p><a
                        href="#"class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Редактировать</a>
                </p>
            </div>
        </div>
        {{-- фильтр (лайки, мои посты и т.д) --}}
        <div class="buttons-group-filter d-flex border-bottom gap-3 py-4 flex-wrap">
            <button type="button" class="btn btn-custom flex-md-auto">Мои посты</button>
            <button type="button" class="btn btn-custom flex-md-auto">Понравившиеся посты</button>
            <button type="button" class="btn btn-custom flex-md-auto">Избранные посты</button>
            <button type="button" class="btn btn-custom flex-md-auto">Комментарии</button>
        </div>
        <div class="list-posts">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="favorite-button">
                            <button type="button" class="btn-light"><img src="/image/heart.svg" alt="heart"></button>
                        </div>
                        <div class="card-body">
                            <div class="tags mb-3">
                                <span class="badge fw-bold text-bg-custom">Процессор</span>
                            </div>
                            <h3 class="card-title">Название поста</h3>
                            <div class="post-info mb-2">
                                <span class="author"><strong>Автор:</strong> danya123</span><br>
                                <span class="date"> <strong>Дата публикации:</strong> 01.01.2023</span>
                            </div>
                            <p class="card-text short-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea suscipit, voluptate ab tenetur laborum modi exercitationem voluptatibus ratione vitae maxime a hic eius mollitia officia, nostrum ipsa ipsam aut praesentium.</p>
                            <img src="/image/test/pc.jpg" class="card-img-top forum-img" alt="pc.jpg">
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <a href="#" class="btn btn-custom">Читать</a>
                                <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                    <button type="button" class="btn btn-like"><img src="/image/up_arrow.svg" alt="up_arrow"></button>
                                    <span class="likes-count text-white mx-2">50</span>
                                    <button type="button" class="btn btn-dislike"><img src="/image/down_arrow.svg" alt="down_arrow"></button>
                                    <button type="button" class="btn btn-comment mx-2"><img src="/image/comment.svg" alt="comment"></button>
                                    <span class="comments-count text-white ml-2">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</body>

</html>
