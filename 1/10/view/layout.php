<!doctype html>
<html lang=ru>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Решение задач по теме "Работа с базой данных. Простейшие запросы на выборку."</title>
    </head>
    <body>
        <div class="container">
            <br>
            <h4>Сообщения</h4>

            <?php foreach ($data_for_page as $message_data): ?>
                <div class="card">
                    <div class="card-header">
                        <p>Пользователь <?= $message_data['user'] ?> написал:</p>
                    </div>
                    <div class="card-body">
                        <p><?= $message_data['message_text'] ?></p>
                    </div>
                    <div class="card-footer">
                        <p><?= date('d.m.Y H:i:s', (int) $message_data['message_time']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <br>
            <?php pagination($pages, $page, 2); ?>
        </div>
    </body>
</html>