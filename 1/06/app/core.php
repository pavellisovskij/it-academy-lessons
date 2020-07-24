<?php

function pagination(int $pages, int $page, int $side_buttons_limit) {
    echo '<div class="pagination justify-content-center">';

    // Ссылки "назад" и "на первую страницу"
    if ($page >= 2 ) {
        // Значение page= для первой страницы всегда равно единице
        echo '<a href="index.php?page=1" class="alert alert-light" role="alert"><<</a>';
        // Предыдущая страница page=-1
        echo '<a href="index.php?page=' . ($page - 1) . '" class="alert alert-light" role="alert"> < </a>';
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
                echo '<a href="index.php?page=' . $page . '" class="alert alert-info" role="alert">' . $j . '</a>';
            }
            // Ссылки на остальные страницы
            else {
                echo '<a href="index.php?page=' . $j . '" class="alert alert-light" role="alert">' . $j . '</a>';
            }
        }
    }

    // Выводим ссылки "вперед" и "на последнюю страницу"
    if ($j > $page && $page + 1 < $j) {
        // Следующая страница
        echo '<a href="index.php?page=' . ($page + 1) . '" class="alert alert-light" role="alert">></a>';
        // Последняя страница
        echo '<a href="index.php?page=' . ($pages - 1) . '" class="alert alert-light" role="alert">>></a>';
    }

    echo '</div>';
}

function highlight_word(string $word, $color = 'red'): string
{
    return '<span style="color: ' . $color . '">' . $word . '</span>';
}

function is_symbol_special(string $symbol): bool
{
    $dash = mb_chr(0x2014, 'UTF-8');
    $special_symbols = [
        ' ', '.', ',', '!', '?', ':', '-', PHP_EOL,
        "\r", "\n", '(', ')', '\'', '"', ';', $dash,
        '«', '»'
    ];

    return in_array($symbol, $special_symbols);
}

function make_first_symbol_bold(string $string): string {
    $result = '';
    if (mb_substr($string, 0, 1) == '<') {
        do {
            $result .= mb_substr($string, 0, 1);
            $string =  mb_substr($string, 1);
        } while ($string != '>');
        $result .= '<b>' . mb_substr($string, 0,1) . '</b>' . mb_substr($string, 1);
    }
    else {
        $result = '<b>' . mb_substr($string, 0,1) . '</b>' . mb_substr($string, 1);;
    }

    return $result;
}

function is_ellipsis_points(string $string): bool {
    if ($string === '... ') return true;
    else return false;
}

function is_end_of_sentence(string $string): bool
{
    $signs = ['. ', '! ', '? '];
    return in_array($string, $signs);
}

function get_word(string $text): string
{
    $word = '';
    while (is_symbol_special(mb_substr($text, 0, 1)) == false) {
        $word .= mb_substr($text, 0, 1);
        $text = mb_substr($text, 1);
    }
    return $word;
}

function debug($var) {
    echo '<pre>';
        var_dump($var);
    echo '</pre>';
    exit;
}


