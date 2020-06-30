<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Задание 1а</title>
</head>
    <body>
        <div class="container">
            <?php
                $color1 = 'red';
                $color2 = 'yellow';
                $color3 = 'green';
                $mark   = 1;
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Число</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 1; $i < mt_rand(2, 20); $i++): ?>
                        <?php if ($mark > 3) $mark = 1 ?>
                        <?php if ($mark == 1): ?>
                            <tr style="background: <?= $color1 ?>">
                        <?php elseif ($mark == 2): ?>
                            <tr style="background: <?= $color2 ?>">
                        <?php elseif ($mark == 3): ?>
                            <tr style="background: <?= $color3 ?>">
                        <?php endif; ?>
                                <td><?= $i ?></td>
                                <td><?= rand() ?></td>
                            </tr>
                        <?php $mark++ ?>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>