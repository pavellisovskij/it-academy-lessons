<!doctype html>
<html lang=ru>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Решение задач по теме "Файлы. Дата, время."</title>
    </head>
    <body>
        <div class="container">
            <br>
            <p>
                <a href="https://habr.com/ru/news/t/511570/" class="btn btn-primary">Статья из которой взят текст</a>
            </p>

            <?php if ($message['type'] == 'success') : ?>
                <div class="alert alert-success" role="alert">
                    <?= $message['text'] ?>
                </div>
            <?php elseif ($message['type'] == 'error') : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message['text'] ?>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>