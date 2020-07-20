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
        "\r", "\n", '(', ')', '\'', '"', ';', $dash
    ];

    return in_array($symbol, $special_symbols);
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

function mb_count_chars(string $input, string $encoding = 'UTF-8'): array {
    $l = mb_strlen($input, $encoding);
    $unique = array();
    for($i = 0; $i < $l; $i++) {
        $char = mb_substr($input, $i, 1, $encoding);
        if(!array_key_exists($char, $unique))
            $unique[$char] = 0;
        $unique[$char]++;
    }
    return $unique;
}

//function debug($var) {
//    echo '<pre>';
//        var_dump($var);
//    echo '</pre>';
//    exit;
//}


