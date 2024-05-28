<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/style.css">
    <title>PcGeek</title>
</head>

<body>
<x-header></x-header>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-3">
            <div class="alert-text">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    <div class="filter-forums row d-flex justify-content-between align-items-center">
        <div class="col-auto">
            <div class="btn-group dropend">
                <button type="button" class="btn btn-custom dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Сортировать по
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/">дате добавления</a></li>
                    <li><a class="dropdown-item" href="/?sort=countlike">кол-ву лайков</a></li>
                    <li><a class="dropdown-item" href="/?sort=countcomment">кол-ву комментариев</a></li>
                    <li><a class="dropdown-item" href="/?sort=oldpost">старые записи</a></li>
                </ul>
            </div>
        </div>
        <div class="col-auto">
            <div class="btn-group dropstart">
                <button type="button" class="btn btn-custom dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Категории
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/">Все категории</a></li>
                    <li><a class="dropdown-item" href="/?category=1">Материнская плата</a></li>
                    <li><a class="dropdown-item" href="/?category=2">Жесткий диск</a></li>
                    <li><a class="dropdown-item" href="/?category=3">Оперативная память</a></li>
                    <li><a class="dropdown-item" href="/?category=4">SSD диск</a></li>
                    <li><a class="dropdown-item" href="/?category=5">Блок питания</a></li>
                    <li><a class="dropdown-item" href="/?category=6">Видеокарта</a></li>
                    <li><a class="dropdown-item" href="/?category=7">Процессор</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="list-forums mt-4">
        <div class="row">
            @forelse ($posts as $post)
                @if($post->is_blocked == 0)
                    <div class="col-md-12">
                        <div class="card mb-4">
                            @auth
                                <div class="favorite-button">
                                    <button id="btn-favorite" type="button" data-post-id="{{$post->id}}"
                                            class="btn-favorite {{$post->isFavorited ? 'favorited' : ''}}"><img
                                            src="/image/heart.svg" alt="heart"></button>
                                </div>
                            @endauth
                            <div class="card-body">
                                <div class="tags mb-3">
                                    @foreach ($post->tags as $tag)
                                        <a href="/?search={{ request()->input('search') ? request()->input('search') . ', ' . $tag->title_tag : $tag->title_tag }}">
                                            <span class="badge fw-bold text-bg-custom">{{ $tag->title_tag }}</span>
                                        </a>
                                    @endforeach

                                </div>
                                <h3 class="card-title">{{ $post->title_post }}</h3>
                                <div class="post-info mb-2">
                                    <span class="author"><strong>Автор: </strong>{{ $post->user->login }}</span><br>
                                    <span class="date"> <strong>Дата публикации:</strong>
                                        {{ date('d.m.Y', strtotime($post->created_at)) }}</span>
                                </div>
                                <p class="card-text short-text">{{ $post->description }}</p>
                                <img src="/storage/image_posts/{{ $post->image_posts }}" class="card-img-top forum-img"
                                     alt="{{ $post->image_posts }}">
                                <div class="d-flex justify-content-between mt-3 align-items-center">
                                    <a href="/forum/{{ $post->id }}" class="btn btn-custom">Читать</a>
                                    <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                        @auth
                                            <button type="button" data-post-id="{{ $post->id }}"
                                                    class="btn btn-like {{ $post->isLiked ? 'liked' : '' }}"><img
                                                    src="/image/up_arrow.svg" alt="up_arrow"></button>

                                            <span data-post-id="{{ $post->id }}"
                                                  class="likes-count text-white px-2">{{ $post->likesCount() }}</span>

                                            <button type="button" data-post-id="{{ $post->id }}"
                                                    class="btn btn-dislike {{ $post->isDissliked ? 'dissliked' : '' }}">
                                                <img
                                                    src="/image/down_arrow.svg" alt="down_arrow"></button>

                                            <span data-post-id="{{ $post->id }}"
                                                  class="dislikes-count text-white px-2">{{ $post->disslikesCount() }}</span>

                                            <a href="/forum/{{ $post->id }}#comment-section"
                                               class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                                                                 alt="comment"></a>

                                            <span
                                                class="comments-count text-white ml-2">{{$post->count_comments()}}</span>
                                        @endauth
                                        @guest
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#signIn"
                                                    class="btn btn-like-guest"><img src="/image/up_arrow.svg"
                                                                                    alt="up_arrow"></button>

                                            <span data-post-id="{{ $post->id }}"
                                                  class="likes-count text-white px-2">{{ $post->likesCount() }}</span>

                                            <button type="button" data-bs-toggle="modal" data-bs-target="#signIn"
                                                    class="btn btn-dislike-guest"><img src="/image/down_arrow.svg"
                                                                                       alt="down_arrow"></button>

                                            <span data-post-id="{{ $post->id }}"
                                                  class="dislikes-count text-white px-2">{{ $post->disslikesCount() }}</span>

                                            <a href="/forum/{{ $post->id }}#comment-section"
                                               class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                                                                 alt="comment"></a>

                                            <span
                                                class="comments-count text-white ml-2">{{$post->count_comments()}}</span>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        Нет постов для отображения.
                    </div>
                </div>
            @endforelse
        </div>
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
    <x-footer></x-footer>
</div>
<x-auth></x-auth>
<x-edit_user></x-edit_user>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/js/like.js"></script>
</body>

</html>
