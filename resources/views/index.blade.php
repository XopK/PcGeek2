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
        <div class="filter-forums row d-flex justify-content-between align-items-center">
            <div class="col">
                <form action="" method="GET">
                    <select class="form-select sort focus-ring focus-ring-secondary" style="border: 2px solid #999999;">
                        <option disabled selected>Сортировка</option>
                        <option value="1">Популярность</option>
                        <option value="2">Дата публикации</option>
                        <option value="3">Алфавит</option>
                        <option value="4">Кол-во лайков (убывание)</option>
                        <option value="5">Кол-во лайков (возрастание)</option>
                    </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-custom">Применить</button>
            </div>
            </form>
        </div>
        <div class="list-forums mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="favorite-button">
                            <button type="button" class="btn-light"><img src="/image/heart.svg"
                                    alt="heart"></button>
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
                            <p class="card-text short-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                                suscipit, voluptate ab tenetur laborum modi exercitationem voluptatibus ratione vitae
                                maxime a hic eius mollitia officia, nostrum ipsa ipsam aut praesentium.</p>
                            <img src="/image/test/test.jpg" class="card-img-top forum-img" alt="pc.jpg">
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <a href="#" class="btn btn-custom">Читать</a>
                                <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                    <button type="button" class="btn btn-like"><img src="/image/up_arrow.svg"
                                            alt="up_arrow"></button>
                                    <span class="likes-count text-white mx-2">50</span>
                                    <button type="button" class="btn btn-dislike"><img src="/image/down_arrow.svg"
                                            alt="down_arrow"></button>
                                    <button type="button" class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                            alt="comment"></button>
                                    <span class="comments-count text-white ml-2">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="favorite-button">
                            <button type="button" class="btn-light"><img src="/image/heart.svg"
                                    alt="heart"></button>
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
                            <p class="card-text short-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                                suscipit, voluptate ab tenetur laborum modi exercitationem voluptatibus ratione vitae
                                maxime a hic eius mollitia officia, nostrum ipsa ipsam aut praesentium.</p>
                            <img src="/image/test/pc.jpg" class="card-img-top forum-img" alt="pc.jpg">
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <a href="#" class="btn btn-custom">Читать</a>
                                <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                    <button type="button" class="btn btn-like"><img src="/image/up_arrow.svg"
                                            alt="up_arrow"></button>
                                    <span class="likes-count text-white mx-2">50</span>
                                    <button type="button" class="btn btn-dislike"><img src="/image/down_arrow.svg"
                                            alt="down_arrow"></button>
                                    <button type="button" class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                            alt="comment"></button>
                                    <span class="comments-count text-white ml-2">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="favorite-button">
                            <button type="button" class="btn-light"><img src="/image/heart.svg"
                                    alt="heart"></button>
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
                            <p class="card-text short-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                                suscipit, voluptate ab tenetur laborum modi exercitationem voluptatibus ratione vitae
                                maxime a hic eius mollitia officia, nostrum ipsa ipsam aut praesentium.</p>
                            <img src="/image/test/test.jpg" class="card-img-top forum-img" alt="pc.jpg">
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <a href="#" class="btn btn-custom">Читать</a>
                                <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                    <button type="button" class="btn btn-like"><img src="/image/up_arrow.svg"
                                            alt="up_arrow"></button>
                                    <span class="likes-count text-white mx-2">50</span>
                                    <button type="button" class="btn btn-dislike"><img src="/image/down_arrow.svg"
                                            alt="down_arrow"></button>
                                    <button type="button" class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                            alt="comment"></button>
                                    <span class="comments-count text-white ml-2">25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="favorite-button">
                            <button type="button" class="btn-light"><img src="/image/heart.svg"
                                    alt="heart"></button>
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
                            <p class="card-text short-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                                suscipit, voluptate ab tenetur laborum modi exercitationem voluptatibus ratione vitae
                                maxime a hic eius mollitia officia, nostrum ipsa ipsam aut praesentium.</p>
                            <img src="/image/test/pc.jpg" class="card-img-top forum-img" alt="pc.jpg">
                            <div class="d-flex justify-content-between mt-3 align-items-center">
                                <a href="#" class="btn btn-custom">Читать</a>
                                <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                    <button type="button" class="btn btn-like"><img src="/image/up_arrow.svg"
                                            alt="up_arrow"></button>
                                    <span class="likes-count text-white mx-2">50</span>
                                    <button type="button" class="btn btn-dislike"><img src="/image/down_arrow.svg"
                                            alt="down_arrow"></button>
                                    <button type="button" class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                            alt="comment"></button>
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
    <x-auth></x-auth>

</body>

</html>
