<!doctype html>
<html lang=ru>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Решение задач по теме "Постраничный вывод информации"</title>
    </head>
    <body>
        <div class="container">
            <br>
            <p>
                <a href="https://habr.com/ru/news/t/511570/" class="btn btn-primary">Статья</a>
            </p>

            <?php foreach ($paragraphs_and_statistics as $array): ?>
                <div class="card">
                    <div class="card-body">
                        <?= $array['paragraph'] ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Предложений: <?= $array['statistics']['sentences'] ?></li>
                        <li class="list-group-item">Слов: <?= $array['statistics']['words'] ?></li>
                        <li class="list-group-item">Символов: <?= $array['statistics']['symbols'] ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>