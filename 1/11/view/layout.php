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
            <?php if (!empty($errors)) : ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form enctype="text/plain" action="" method="post">
                        <div class="form-group">
                            <label for="text">Проверить текст:</label>
                            <input type="text" class="form-control" name="text" id="text" required>
                        </div>

                        <div class="form-group">
                            <label for="number">Проверить текст:</label>
                            <input type="number" class="form-control" name="number" id="number" required>
                        </div>

                        <div class="form-group">
                            <label for="">Телефон:</label>
                            <input type="tel" placeholder="+000 (00) 000-00-00">
                        </div>

                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>