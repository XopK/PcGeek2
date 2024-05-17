<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/style.css">
    <title>Админ-панель</title>
    <style>
        .loading-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .disabled-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(251, 251, 251, 0.7);
            z-index: 9998;
        }
    </style>
</head>

<body>
<x-admin-header></x-admin-header>
<div class="container">
    <h1 class="mb-3">Парсер</h1>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible mt-3">
            <div class="alert-text">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Запуск скриптов</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="/admin/MotherBoard" class="btn btn-custom"
                       onclick="handleButtonClick(event, 'MotherBoard')">Материнская плата</a>
                </li>
                <li class="list-group-item">
                    <a href="/admin/HDD" class="btn btn-custom" onclick="handleButtonClick(event, 'HDD')">Жесткий
                        диск</a>
                </li>
                <li class="list-group-item">
                    <a href="/admin/RAM" class="btn btn-custom" onclick="handleButtonClick(event, 'RAM')">Оперативная
                        память</a>
                </li>
                <li class="list-group-item">
                    <a href="/admin/SSD_disk" class="btn btn-custom" onclick="handleButtonClick(event, 'SSD_disk')">SSD
                        диски</a>
                </li>
                <li class="list-group-item">
                    <a href="/admin/PowerBlock" class="btn btn-custom" onclick="handleButtonClick(event, 'PowerBlock')">Блок
                        питания</a>
                </li>
                <li class="list-group-item">
                    <a href="/admin/GraphicCard" class="btn btn-custom"
                       onclick="handleButtonClick(event, 'GraphicCard')">Видеокарта</a>
                </li>
                <li class="list-group-item">
                    <a href="/admin/processor" class="btn btn-custom" onclick="handleButtonClick(event, 'processor')">Процессор</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="loading-spinner">
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<div class="disabled-overlay"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/js/parser.js"></script>
</body>
</html>
