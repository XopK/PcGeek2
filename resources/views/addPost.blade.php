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
            <form action="" method="post">
                <div class="mb-3">
                    <label for="postText" class="form-label">Текст поста</label>
                    <textarea class="form-control focus-ring focus-ring-secondary border-secondary" id="postText" rows="5"
                        placeholder="Введите здесь свой текст"></textarea>
                </div>
                <div class="mb-3">
                    <label for="imageUpload" class="form-label">Загрузить изображение</label>
                    <input class="form-control focus-ring focus-ring-secondary border-secondary" type="file"
                        id="imageUpload">
                </div>
                <div class="mb-3">
                    <label for="postTags" class="form-label">Теги</label>
                    <input class="form-control focus-ring focus-ring-secondary border-secondary" id="postTags"
                        placeholder="Введите теги">
                </div>
                <div class="mb-3">
                    <label for="pcComponents" class="form-label">PC Components</label>
                    <select class="form-select focus-ring focus-ring-secondary border-secondary " id="pcComponents">
                        <option value="1">CPU</option>
                        <option value="2">GPU</option>
                        <option value="3">RAM</option>
                        <option value="4">Storage</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom">Добавить</button>
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
            var allTags = [
                "PC Hardware",
                "Gaming",
                "Software",
                "Tech Support",
                "Искусственный интеллект",
                "Машинное обучение",
                "Блокчейн",
                "Криптовалюты",
                "Интернет вещей (IoT)",
                "Робототехника",
                "Виртуальная реальность",
                "Дополненная реальность",
                "Биг-дата (Big Data)",
                "Облачные вычисления",
                "Кибербезопасность",
                "Игровая разработка",
                "Финтех",
                "Медицинская технология",
                "Нейронные сети",
                "Автоматизация процессов",
                "Роботизация производства",
                "Космическая технология",
                "Экологические технологии",
                "Архитектура ПО",
                "Мобильная разработка",
                "Веб-разработка",
                "Аналитика данных",
                "Интернет маркетинг",
                "Электронная коммерция",
                "Разработка приложений для здоровья",
                "Компьютерные игры",
                "Разработка виртуальных миров",
                "Биотехнологии",
                "Нанотехнологии"
            ];

            $("#postTags").autocomplete({
                source: function(request, response) {
                    var term = request.term.toLowerCase();
                    var filteredTags = allTags.filter(function(tag) {
                        return tag.toLowerCase().indexOf(term) !== -1;
                    });
                    response(filteredTags.slice(0,
                        5)); // Ограничиваем список первыми пятью совпадениями
                },
                minLength: 0,
                select: function(event, ui) {
                    var currentValue = $("#postTags").val(); // Текущее значение поля
                    var selectedTag = ui.item.value; // Выбранный тег
                    var updatedValue = currentValue.trim(); // Удаляем лишние пробелы с начала и конца
                    if (updatedValue) {
                        // Добавляем запятую и пробел, если в поле уже есть теги
                        updatedValue += ", ";
                    }
                    updatedValue += selectedTag; // Добавляем выбранный тег
                    $("#postTags").val(updatedValue); // Обновляем значение поля
                    return false; // Предотвращаем стандартное поведение выбора
                }
            }).focus(function() {
                $(this).autocomplete("search", ""); // При фокусировке открываем выпадающий список
            });
        });
    </script>
</body>

</html>
