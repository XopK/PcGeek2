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
        @forelse($comments as $comment)
            <a href="/forum/{{$comment->id_post}}#comment-section" style="text-decoration: none">
                <div class="card mb-4">
                    <div class="card-header">
                        {{$comment->post->title_post}}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{$comment->comment}}</p>
                            <footer
                                    class="blockquote-footer">{{ date('d.m.Y', strtotime($comment->created_at)) }}</footer>
                        </blockquote>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    Нет комментариев для отображения.
                </div>
            </div>
        @endforelse
        {{ $comments->links('pagination::bootstrap-5') }}
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
