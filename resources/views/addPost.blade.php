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
            <h1>Добавление поста</h1>
            <form action="/addPost/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="postTitle" class="form-label fw-bold">Название поста</label>
                    <input class="form-control focus-ring focus-ring-secondary border-secondary" name="post_title"
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
                    <textarea class="form-control focus-ring focus-ring-secondary border-secondary" name="text_post" id="postText"
                        rows="5" placeholder="Введите здесь свой текст"></textarea>
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
                        type="file" id="imageUpload">
                    @error('photo_post')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
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
                <div class="mb-3">
                    <label for="pcComponents" class="form-label fw-bold">Выберите категорию</label>
                    <select class="form-select focus-ring focus-ring-secondary border-secondary" id="pcComponents">
                        <option value="7">Процессор</option>
                        <option value="6">Видеокарта</option>
                        <option value="5">Блок питания</option>
                        <option value="4">SSD</option>
                        <option value="3">Оперативная память</option>
                        <option value="2">Жесткий диск</option>
                        <option value="1">Материнская плата</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="componentSelect" class="form-label fw-bold">Выберите компонент</label>
                    <input type="text" class="form-control focus-ring focus-ring-secondary border-secondary"
                        id="componentInput" name="component_title" placeholder="Введите название компонента">
                    <!-- Здесь будут загружаться компоненты по выбранной категории -->
                    <input type="hidden" id="component_id" name="component_id">
                    @error('component_id')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @enderror

                </div>
                <button type="submit" class="btn btn-custom">Добавить</button>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible mt-3">
                        <div class="alert-text">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
        <x-footer></x-footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"
        integrity="sha256-sw0iNNXmOJbQhYFuC9OF2kOlD5KQKe1y5lfBn4C9Sjg=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $("#postTags").autocomplete({
                source: function(request, response) {
                    var term = request.term.toLowerCase();
                    $.ajax({
                        url: '/' + $('#postTags').data(
                            'tags'), // Здесь используем data-tags для получения URL
                        dataType: 'json',
                        data: {
                            term: term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 0,
                select: function(event, ui) {
                    var currentValue = $("#postTags").val();
                    var selectedTag = ui.item.value;
                    var updatedValue = currentValue.trim();
                    if (updatedValue) {
                        updatedValue += ", ";
                    }
                    updatedValue += selectedTag;
                    $("#postTags").val(updatedValue);
                    return false;
                }
            }).focus(function() {
                $(this).autocomplete("search", "");
            });

            function loadComponents(categoryId) {
                $.ajax({
                    url: '/components/' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        var availableComponents = data.map(function(component) {
                            return {
                                label: component.title_component,
                                value: component.id
                            };
                        });

                        $('#componentInput').autocomplete({
                            source: function(request, response) {
                                var term = request.term.toLowerCase();
                                var filteredComponents = availableComponents.filter(
                                    function(component) {
                                        return component.label.toLowerCase().indexOf(
                                            term) !== -1;
                                    });
                                response(filteredComponents.slice(0,
                                    12));
                            },
                            select: function(event, ui) {
                                $('#componentInput').val(ui.item
                                    .label
                                );
                                $('#component_id').val(ui.item
                                    .value
                                );
                                return false;
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $('#pcComponents').change(function() {
                var categoryId = $(this).val();
                loadComponents(categoryId);
            });


            $('#pcComponents').trigger('change');

        });
    </script>
</body>

</html>
