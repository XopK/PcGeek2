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
    <title>Панель модератора</title>
</head>

<body>
<x-moderator-header></x-moderator-header>
<div class="container">
    <h1 class="mb-3">Заблокированные посты</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-3">
            <div class="alert-text">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    <div class="table-responsive mb-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название поста</th>
                <th scope="col">Текст поста</th>
                <th scope="col">Пользователь</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Причина бана</th>
                <th scope="col"></th>
            </tr>
            </thead>

            <tbody>
            @forelse($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title_post}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->user->login}}</td>
                    <td>{{ date('d.m.Y', strtotime($post->created_at)) }}</td>
                    <td>{{$post->reports->response}}</td>
                    <td><a href="/moderator/postsBan/denay/{{$post->id}}"
                           class="btn btn-custom accept-btn btn-sm">Разблокировать</a></td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
