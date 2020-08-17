<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'app/core.php';

$suitable_sentences = [];
$search_words = [
    'года',
    'windows',
    'разделе',
    'GB'
];
$carriage_return = "\r\n";

try {
    $f = fopen('files/text.txt','r');
    while (!feof($f)) {
        $text = fgets($f); //читаем построчно
        $text = trim($text, $carriage_return);
        $sentence = '';
       // echo $text;

        while ($text) {
            $symbol = mb_substr($text, 0, 1);

            if (is_symbol_special($symbol) == false) {
                $word = get_word($text);
                $text = mb_substr($text, mb_strlen($word));

                foreach ($search_words as $search_word) {
                    if (mb_strtolower($search_word) === mb_strtolower($word)) {
                        $word_found = true;
                    }
                }

                $sentence .= $word;
            }
            else {
                if (is_end_of_sentence(mb_substr($text, 0, 2)) == true) {
                    $sentence .= mb_substr($text, 0, 2);
                    $text = mb_substr($text, 2);

                    if ($word_found == true) {
                        $suitable_sentences[] = trim($sentence);
                        $sentence = '';
                        $word_found = false;

                    }
                }
                elseif (is_ellipsis_points(mb_substr($text, 0, 4)) == true) {
                    $sentence .= mb_substr($text, 0, 4);
                    $text = mb_substr($text, 4);
                    if ($word_found == true) {
                        $suitable_sentences[] = trim($sentence);
                        $sentence = '';
                        $word_found = false;
                    }
                }
                else {
                    $sentence .= $symbol;
                    $text = mb_substr($text, 1);
                }
            }
        }
    }
    fclose($f);

    if ($file = fopen('files/result_text.txt','w')) {
        foreach ($suitable_sentences as $sentence) {
            fwrite($file, $sentence . $carriage_return);
        }
        fclose($file);

        $message = [
            'text' => "Файл создан в папке files",
            'type' => 'success'
        ];
    }
    else {
        $message = [
            'text' => "Файл не создан",
            'type' => 'error'
        ];
    }

    require 'view/layout.php';
} catch (Throwable $e) {
    echo $e->getMessage();
}