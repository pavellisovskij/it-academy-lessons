<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Задание 2</title>
    </head>
    <body>
        <div class="container">
            <p>
                <b>Задание 2.</b>
                Преобразовать массив таким образом, чтобы в первой его половине
                располагались элементы, стоявшие в исходном массиве на нечетных позициях
                (1, 2, 3, ...), а во второй половине — элементы, стоявшие на четных позициях
                (0, 2, 4, ...)
            </p>
            <hr>

            <?php
                $array = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
                $result_array = [];

                for ($i = 0; $i < count($array); $i++) {
                    if ($i % 2 == 0) {
                        $even_array[] = $array[$i];
                    }
                    else {
                        $odd_array[] = $array[$i];
                    }
                }

                $result_array = array_merge($odd_array, $even_array);
            ?>

            <p>Исходный массив: [
                <b>
                    <?php foreach ($array as $value) : ?>
                        <?= $value . ' ' ?>
                    <?php endforeach; ?>
                </b>
            ]</p>

            <p>Результирующий массив: [
                <b>
                    <?php foreach ($result_array as $value) : ?>
                        <?= $value . ' ' ?>
                    <?php endforeach; ?>
                </b>
            ]</p>

            <hr>
            <a href="index.php" class="btn btn-primary">К списку задач</a>
        </div>
    </body>
</html>