<?php

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

function is_symbol_special(string $symbol): bool
{
    //$dash = mb_chr(0x2014, 'UTF-8');
    $special_symbols = [
        ' ', '.', ',', '!', '?', ':', '-', PHP_EOL,
        "\r", "\n", '(', ')', '\'', '"', ';', //$dash,
        '«', '»'
    ];

    return in_array($symbol, $special_symbols);
}

function debug($var) {
    echo '<pre>';
        var_dump($var);
    echo '</pre>';
    exit;
}