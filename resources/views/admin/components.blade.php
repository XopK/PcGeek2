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
    <h1 class="mb-3">Компоненты</h1>
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
                <th scope="col">Название компонента</th>
                <th scope="col">Хар-ки компонента</th>
                <th scope="col">Категория</th>
                <th scope="col">Цена</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($components as $component)
                <tr>
                    <th>{{$component->id}}</th>
                    <td>{{$component->title_component}}</td>
                    <td>{{$component->config_component}}</td>
                    <td>{{$component->category->title_category_components}}</td>
                    <td>{{$component->sale}}</td>
                    <td><a href="/admin/components/{{$component->id}}/edit"
                           class="btn btn-custom edit-btn btn-sm">Редактировать</a></td>
                    <td><a href="/admin/components/delete/{{$component->id}}"
                           class="btn btn-custom delete-btn btn-sm">Удалить</a></td>
                </tr>
            @empty
            @endforelse

            </tbody>
        </table>
    </div>
    {{ $components->links('pagination::bootstrap-5') }}
</div>
</body>
</html>
