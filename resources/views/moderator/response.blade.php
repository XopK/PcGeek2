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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-3">
            <div class="alert-text">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    <form action="/moderator/report/{{$response->id}}/accept" method="post">
        @csrf
        <div class="mb-3">
            <label for="response" class="form-label">Причина блокировки</label>
            <textarea name="response" class="form-control" id="response" rows="5"></textarea>
            @error('response')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-custom">Заблокировать</button>
    </form>
</div>

</div>
</body>
</html>
