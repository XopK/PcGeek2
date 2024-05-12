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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>PcGeek</title>
</head>

<body>
<x-header></x-header>
<div class="container">
    <div class="header-forum-page d-flex gap-2 mt-4">
        <div class="back-page">
            <a href="/" class="btn btn-custom btn-sm">
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
            <p class="fw-medium m-0">{{ $post->user->login }}</p>
            <p class="fw-light m-0">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <div class="forum-page-post mt-3">
        <h1>{{ $post->title_post }}</h1>
        <div class="tags mb-3">
            @foreach ($post->tags as $tag)
                <span class="badge fw-bold text-bg-custom">{{ $tag->title_tag }}</span>
            @endforeach
        </div>
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text fw-medium">{{ $post->description }}</p>
                    <img src="/storage/image_posts/{{ $post->image_posts }}" class="card-img-top forum-page-img"
                         alt="{{ $post->image_posts }}">
                    <div class="d-flex gap-3">
                        <div class="d-flex justify-content-between mx-0 mt-3">
                            <div class="like-dislike-buttons d-flex align-items-center">
                                <button type="button" data-post-id="{{ $post->id }}"
                                        class="btn btn-like {{ $post->isLiked ? 'liked' : '' }}"><img
                                        src="/image/up_arrow.svg" alt="up_arrow"></button>

                                <span data-post-id="{{ $post->id }}"
                                      class="likes-count text-white px-2">{{ $post->likesCount() }}</span>

                                <button type="button" data-post-id="{{ $post->id }}"
                                        class="btn btn-dislike {{ $post->isDissliked ? 'dissliked' : '' }}"><img
                                        src="/image/down_arrow.svg" alt="down_arrow"></button>

                                <span data-post-id="{{ $post->id }}"
                                      class="dislikes-count text-white px-2">{{ $post->disslikesCount() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="components-list">
        <h2 class="mb-4">Комплектующие</h2>
        @forelse($post->components as $component)
            <div class="card mb-3" style="width: 83%">
                <div class="d-flex">
                    <div class="flex-grow-0">
                        <img src="{{$component->image_components}}" class="img-fluid rounded-start p-3"
                             alt="{{$component->image_components}}">
                    </div>
                    <div class="flex-grow-1">
                        <div class="card-body">
                            <h5 class="card-title">{{$component->title_component}}</h5>
                            <p class="card-text">{{$component->config_component}}</p>
                            <p class="card-text fs-4 fw-bold">{{$component->sale}}</p>
                        </div>
                    </div>
                </div>
            </div>

        @empty
        @endforelse
    </div>
    <div class="comment-section mt-4">
        <h2 id="comment-section">Комментарии</h2>
        <hr>
        <div class="add-comment d-flex gap-2 mt-2">
            <img src="/image/profile.svg" class="profile-img-forum" alt="profile.svg">
            <form id="commentForm" class="d-flex align-items-center gap-2 w-100" data-post-id="{{$post->id}}" method="post">
                @csrf
                <input class="form-control" name="comment" placeholder="Напишите комментарий здесь...">
                <button type="submit" class="btn btn-custom">Отправить</button>
            </form>

        </div>
        <div class="comments mt-4">
            @forelse($post->comments as $comment)
                <div class="comment d-flex gap-2 mb-3">
                    <img src="/storage/users_profile/{{$comment->users->profile_img}}" class="profile-img-forum"
                         alt="profile.svg">
                    <div class="comment-content" style="width: 100%">
                        <div class="author-comment d-flex justify-content-between">
                            <div class="author-info d-flex gap-2">
                                <p class="fw-medium m-0">{{$comment->users->login}}</p>
                                <p class="fw-light m-0">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <p class="comment-text">{{$comment->comment}}</p>
                        <button type="button"
                                class="reply-btn link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                            Ответить
                        </button>
                        <div class="reply-form d-none mt-2">
                            <form class="d-flex align-items-center gap-2 w-100">
                                <input class="form-control" placeholder="Напишите ответ здесь...">
                                <button type="submit" class="btn btn-custom btn-sm">Отправить</button>
                            </form>
                        </div>
                        <div class="replies mt-3">
                            <!-- Repeat this structure for each reply -->
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <x-footer></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/js/forum.js"></script>
    <script src="/js/like.js"></script>
</body>

</html>
