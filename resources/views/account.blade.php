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
    <div class="profile-header d-flex mt-4  ">
        <img src="/storage/users_profile/{{Auth::user()->profile_img}}" class="profile-img" alt="profile.svg">
        <div class="login-user-edit mx-3">
            <p class="mb-0 fs-1 fw-bold p-0">{{ Auth::user()->login }}</p>
            <button style="background-color: white; border: none; padding: 0" type="button" data-bs-toggle="modal"
                    data-bs-target="#editUser"
                    class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                Редактировать
            </button>
        </div>
    </div>
    <div class="buttons-group-filter d-flex border-bottom gap-3 py-4 flex-wrap">
        <a href="/profile" class="btn btn-custom flex-md-auto">Мои посты</a>
        <a href="/profile?sort=liked" class="btn btn-custom flex-md-auto">Понравившиеся посты</a>
        <a href="/profile?sort=favorited" class="btn btn-custom flex-md-auto">Избранные посты</a>
        <a href="/profile/comments" class="btn btn-custom flex-md-auto">Комментарии</a>
    </div>
    <div class="list-posts">
        <div class="row mt-4">
            @forelse ($posts as $post)
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
                                    <a href="/?search={{$tag->title_tag}}"><span
                                            class="badge fw-bold text-bg-custom">{{ $tag->title_tag }}</span></a>
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
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="/forum/{{ $post->id }}" class="btn btn-custom">Читать</a>
                                    @if($post->user->id == Auth::user()->id)
                                        <a href="/edit/{{ $post->id }}"
                                           class="btn btn-custom edit-btn">Редактировать</a>
                                        <a href="/delete/{{ $post->id }}" class="btn btn-custom delete-btn">Удалить</a>
                                    @endif
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
                </div>
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
<x-edit_user></x-edit_user>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/js/like.js"></script>
</body>

</html>
