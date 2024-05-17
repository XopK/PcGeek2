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
    <h1>Жалоба на пост {{$post_report->title_post}}</h1>
    <form action="/report" method="post">
        @csrf
        <div class="mb-3">
            <label for="reports" class="form-label">Причина жалобы</label>
            <textarea name="text_report" class="form-control" id="reports" rows="5"></textarea>
            @error('text_report')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
            @enderror
            <input type="hidden" name="id_post" value="{{$post_report->id}}">
        </div>
        <button type="submit" class="btn btn-custom">Отправить</button>
    </form>
    <x-footer></x-footer>
</div>
<x-auth></x-auth>
<x-edit_user></x-edit_user>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>
