<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Задание 3</title>
    </head>
    <body>
        <div class="container">
            <p>
                <b>Задание 3.</b>
                В двумерном массиве определить номера столбцов, не содержащих ни
                одного нулевого элемента, и вычислить произведения элементов каждого из
                этих столбцов.
            </p>
            <hr>

            <?php
                $array = [
                    [1, 2, 3, 4, 5],
                    [1, 2, 3, 0, 5],
                    [1, 2, 3, 0, 5],
                    [1, 2, 0, 4, 5],
                    [1, 2, 3, 4, 5],
                ];
            ?>


            <table class="table">
                <thead>
                    <tr>
                        <td colspan="<?= count($array[0]) ?> " class="text-center">Массив значений:</td>
                    </tr>
                </thead>
                <?php foreach ($array as $row) : ?>
                    <tr>
                        <?php foreach ($row as $value) : ?>
                            <td><?= $value ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php
                for ($i = 0; $i < count($array[0]); $i++) {
                    $column = array_column($array, $i);
                    if (in_array(0, $column) == false) {
                        $prod = 1;
                        for ($j = 0; $j < count($column); $j++) {
                            $prod = $prod * $column[$j];
                        }
                        echo "<p>Произведение элементов <b>$i</b> столбца равняется <b>$prod</b></p>";
                    }
                }
            ?>

            <hr>
            <a href="index.php" class="btn btn-primary">К списку задач</a>
        </div>
    </body>
</html>