<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            text-align: center;
        }
        h1 {
            font-size: 2.5em;
            color: #333333;
        }
        p {
            font-size: 1.2em;
            color: #666666;
        }
        .contact-support {
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>{{ $title }}</h1>
    <p>{{ $content }}</p>
    <p>Если вы считаете, что это ошибка, пожалуйста, свяжитесь с нашей службой поддержки для получения дополнительной информации.</p>
    <div class="contact-support">
        <a href="mailto:support@pcgeek.com" class="btn">Связаться с поддержкой</a>
    </div>
</div>
</body>

</html>
