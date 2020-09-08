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
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <?php if (!empty($errors)) : ?>
                        <?php foreach ($errors as $error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <h4>Добавить сообщение:</h4>
                    <div class="card">
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="index.php" method="post">
                                <div class="form-group">
                                    <label for="user">Имя пользователя:</label>
                                    <input type="text" class="form-control" name="user" id="user" required>
                                </div>

                                <div class="form-group">
                                    <label for="message">Сообщение:</label>
                                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                </div>

                                <input type="file" multiple name="images[]" id="img" accept="image/*">
                                <br><br>

                                <input type="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h4>Сообщения:</h4>
                    <?php foreach ($data_for_page as $message_data): ?>
                        <div class="card">
                            <div class="card-header">
                                Пользователь <?= $message_data['user'] ?> написал:
                            </div>
                            <div class="card-body">
                                <?= $message_data['message_text'] ?>
                            </div>
                            <?php foreach ($message_data['images'] as $image): ?>
                                <img class="card-img-bottom" src="images/<?= $image ?>" alt="Card image cap">
                            <?php endforeach; ?>
                            <div class="card-footer">
                                <?= date('d.m.Y H:i:s', (int) $message_data['message_time']) ?>
                            </div>
                        </div>
                        <br>
                    <?php endforeach; ?>

                    <br>
                    <?php pagination($pages, $page, 2); ?>
                </div>
            </div>
        </div>
    </body>
</html>