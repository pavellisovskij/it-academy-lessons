<?php

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


