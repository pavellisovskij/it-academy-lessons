<?php

function pagination(int $pages, int $page, int $side_buttons_limit) {
    echo '<div class="pagination justify-content-center">';

    // Ссылки "назад" и "на первую страницу"
    if ($page >= 2 ) {
        // Значение page= для первой страницы всегда равно единице
        echo '<a href="../index.php?page=1" class="alert alert-light" role="alert"><<</a>';
        // Предыдущая страница page=-1
        echo '<a href="../index.php?page=' . ($page - 1) . '" class="alert alert-light" role="alert"> < </a>';
    }

    // Узнаем с какой ссылки начинать вывод
    $start = $page - $side_buttons_limit;
    // Узнаем номер последней ссылки для вывода
    $end = $page + $side_buttons_limit;

    // Выводим ссылки на все страницы
    // Начальное число $j в нашем случае должно равнятся единице, а не нулю
    for ($j = 1; $j < $pages; $j++) {

        // Выводим ссылки только в том случае, если их номер больше или равен
        // начальному значению, и меньше или равен конечному значению
        if ($j >= $start && $j <= $end) {

            // Выделяем ссылку на текущую страницу
            if ($j == $page) {
                echo '<a href="../index.php?page=' . $page . '" class="alert alert-info" role="alert">' . $j . '</a>';
            }
            // Ссылки на остальные страницы
            else {
                echo '<a href="../index.php?page=' . $j . '" class="alert alert-light" role="alert">' . $j . '</a>';
            }
        }
    }

    // Выводим ссылки "вперед" и "на последнюю страницу"
    if ($j > $page && $page + 1 < $j) {
        // Следующая страница
        echo '<a href="../index.php?page=' . ($page + 1) . '" class="alert alert-light" role="alert">></a>';
        // Последняя страница
        echo '<a href="../index.php?page=' . ($pages - 1) . '" class="alert alert-light" role="alert">>></a>';
    }

    echo '</div>';
}

function debug($var) {
    echo '<pre>';
        var_dump($var);
    echo '</pre>';
    exit;
}


