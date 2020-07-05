<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Задание 1</title>
    </head>
    <body>
        <div class="container">
            <p><b>Задание 1.</b> Определить произведение элементов массива, расположенных между максимальным и минимальным элементами.</p>
            <hr>

            <?php
                $array          = [3, 10, 5, 6, 2, 5];
                $min            = 2147483647;
                $max            = -2147483648;
                $index_of_min   = null;
                $index_of_max   = null;
                $result         = 1;

                for ($i = 0; $i < count($array); $i++) {
                    if ($array[$i] <= $min) {
                        $min            = $array[$i];
                        $index_of_min   = $i;
                    }
                    if ($array[$i] >= $max) {
                        $max            = $array[$i];
                        $index_of_max   = $i;
                    }
                }
                
                if (($index_of_min + 1 == $index_of_max) || ($index_of_max + 1 == $index_of_min)) {
                    $result = "минимальное и максимальное числа стоят рядом друг с другом";
                }
                elseif ($index_of_min < $index_of_max) {
                    for ($i = $index_of_min + 1; $i < $index_of_max; $i++) {
                        $result *= $array[$i];
                    }
                }
                elseif ($index_of_min > $index_of_max) {
                    for ($i = $index_of_max + 1; $i < $index_of_min; $i++) {
                        $result *= $array[$i];
                    }
                }
                elseif ($index_of_min == $index_of_max) {
                    $result = "Все элементы массива равны. Нет максимального и минимального чисел.";
                }
            ?>

            <p>Массив: [
                <?php foreach ($array as $value) : ?>
                    <?= $value . ' ' ?>
                <?php endforeach; ?>
            ]</p>

            <p>Произведение чисел: <b><?= $result ?></b>.</p>

            <hr>
            <a href="index.php" class="btn btn-primary">К списку задач</a>
        </div>
    </body>
</html>