<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <title>PcGeek</title>
</head>

<body>
<x-header></x-header>
<div class="container">
    <div class="form-addPost mt-4">
        <h1>Редактирование поста</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible mt-3">
                <div class="alert-text">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        <form action="/edit/store/{{$edit->id}}" method="post" id="editPost" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="postTitle" class="form-label fw-bold">Название поста</label>
                <input class="form-control focus-ring focus-ring-secondary border-secondary"
                       value="{{$edit->title_post}}" name="post_title"
                       id="postTitle" placeholder="Введите название">
                @error('post_title')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="postText" class="form-label fw-bold">Текст поста</label>
                <textarea class="form-control focus-ring focus-ring-secondary border-secondary" name="text_post"
                          id="postText"
                          rows="5" placeholder="Введите здесь свой текст">{{$edit->description}}</textarea>
                @error('text_post')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="imageUpload" class="form-label fw-bold">Загрузить изображение</label>
                <input class="form-control focus-ring focus-ring-secondary border-secondary" name="photo_post"
                       type="file" id="imageUpload" accept="image/*">
                @error('photo_post')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <h5>Нажмите на тег чтобы удалить</h5>
                <div class="tags mb-3">
                    @foreach ($edit->tags as $tag)
                        <a href="/edit/deleteTag/{{$tag->id}}?idPost={{$edit->id}}"><span
                                    class="badge fw-bold text-bg-custom">{{ $tag->title_tag }}</span></a>
                    @endforeach

                </div>
                <label for="postTags" class="form-label fw-bold">Теги</label>
                <input class="form-control focus-ring focus-ring-secondary border-secondary" name="tags_post"
                       id="postTags" placeholder="Введите теги" data-tags="tags">
                @error('tags_post')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            </div>
            <div class="d-flex mb-3 gap-2 align-items-center">
                <h3 class="m-0">Компоненты</h3>
                <button type="button" class="btn-plus" id="duplicateButton"><img src="/image/addplus.svg"
                                                                                 alt="addPlus"></button>
            </div>
            <div class="mb-3 border border-secondary p-3 rounded component-block">
                <label for="pcComponents" class="form-label fw-bold">Выберите категорию</label>
                <select class="form-select mb-3 focus-ring focus-ring-secondary border-secondary" id="pcComponents">
                    <option value="7">Процессор</option>
                    <option value="6">Видеокарта</option>
                    <option value="5">Блок питания</option>
                    <option value="4">SSD</option>
                    <option value="3">Оперативная память</option>
                    <option value="2">Жесткий диск</option>
                    <option value="1">Материнская плата</option>
                </select>
                <label for="componentSelect" class="form-label fw-bold">Выберите компонент</label>
                <input type="text" class="form-control mb-3 focus-ring focus-ring-secondary border-secondary"
                       id="componentInput" name="component_title[]" placeholder="Введите название компонента">

                <input type="hidden" id="component_id" name="component_id[]">

                @error('component_id')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
                @enderror
            </div>
            @forelse($edit->components as $component)
                <div class="card mb-3" style="width: 83%">
                    <div class="d-flex align-items-center">
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
                        <a href="/edit/deleteComponents/{{$component->id}}?idPost={{$edit->id}}"
                           class="btn btn-custom delete-btn mx-3">Удалить</a>
                    </div>
                </div>
            @empty
            @endforelse
            <button type="submit" form="editPost" class="btn btn-custom">Опубликовать</button>
        </form>
    </div>
    <x-footer></x-footer>
</div>
<x-edit_user></x-edit_user>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"
        integrity="sha256-sw0iNNXmOJbQhYFuC9OF2kOlD5KQKe1y5lfBn4C9Sjg=" crossorigin="anonymous"></script>
<script src="/js/component.js"></script>
</body>

</html>
