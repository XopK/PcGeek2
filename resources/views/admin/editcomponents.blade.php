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
    <title>Админ-панель</title>
</head>

<body>
<x-admin-header></x-admin-header>
<div class="container">
    <h1 class="mb-3">Редактировать компонент</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-3">
            <div class="alert-text">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    <form action="/admin/components/update/{{$component->id}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title_component" class="form-label fw-bold">Название компонента</label>
            <input value="{{$component->title_component}}" type="text"
                   class="form-control focus-ring focus-ring-secondary border-secondary"
                   name="title_component"
                   id="title_component">
            @error('title_component')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="config_component" class="form-label fw-bold">Характеристики компонента</label>
            <textarea class="form-control focus-ring focus-ring-secondary border-secondary" name="config_component"
                      id="config_component"
                      rows="5">{{$component->config_component}}</textarea>
            @error('config_component')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sale" class="form-label fw-bold">Цена</label>
            <input value="{{$component->sale}}" class="form-control focus-ring focus-ring-secondary border-secondary"
                   name="sale"
                   id="sale">
            @error('sale')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-custom">Редактировать</button>
    </form>
</div>
</body>
</html>
