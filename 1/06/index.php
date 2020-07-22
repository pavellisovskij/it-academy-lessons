<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'app/core.php';
require 'app/text.php';

$paragraphs = explode("\r\n", $text);
$paragraphs = array_values(array_filter($paragraphs, function ($paragraph) {
   return !empty($paragraph);
}));
$paragraphs_per_page        = 5;
$number_of_paragraphs       = count($paragraphs);
$pages                      = ceil($number_of_paragraphs / $paragraphs_per_page);
$paragraphs_and_statistics  = [];
$search_words               = [
    'года',
    'windows',
    'разделе'
];

if (!isset($_GET['page'])) {
    $page = 1;
}
else {
    $page = (int) $_GET['page'];
}

if ($page <= $pages) {
    for ($i = $page * $paragraphs_per_page - $paragraphs_per_page; $i < $paragraphs_per_page * $page; $i++) {
        $number_of_sentences    = 1;
        $number_of_words        = 0;
        $number_of_symbols      = 0;
        $result_paragraph       = '';
        $paragraph              = $paragraphs[$i];
        $start_of_sentence      = true;

        while ($paragraph) {
            $symbol = mb_substr($paragraph, 0, 1);

            if (is_symbol_special($symbol) == false) {
                $word = get_word($paragraph);
                $number_of_words++;
                $number_of_symbols += mb_strlen($word);
                $paragraph = mb_substr($paragraph, mb_strlen($word));

                foreach ($search_words as $search_word) {
                    if (mb_strtolower($search_word) === mb_strtolower($word)) {
                        $word = highlight_word($word);
                    }
                }

                if ($start_of_sentence == true) {
                    $word = make_first_symbol_bold($word);
                    $start_of_sentence = false;
                }

                $result_paragraph .= $word;
            }
            else {
                if (is_end_of_sentence(mb_substr($paragraph, 0, 2)) == true) {
                    $number_of_sentences++;
                    $number_of_symbols += 2;
                    $result_paragraph .= mb_substr($paragraph, 0, 2);
                    $paragraph = mb_substr($paragraph, 2);
                    $start_of_sentence = true;
                }
                elseif (is_ellipsis_points(mb_substr($paragraph, 0, 2)) == true) {
                    $number_of_sentences++;
                    $number_of_symbols += 4;
                    $result_paragraph .= mb_substr($paragraph, 0, 4);
                    $paragraph = mb_substr($paragraph, 4);
                    $start_of_sentence = true;
                }
                else {
                    $result_paragraph .= $symbol;
                    $number_of_symbols++;
                    $paragraph = mb_substr($paragraph, 1);
                }
            }
        }
        $result_paragraph = '<p>' . $result_paragraph . '</p>';

        $paragraphs_and_statistics[] = [
            'paragraph'     => $result_paragraph,
            'statistics'    => [
                'sentences' => $number_of_sentences,
                'words'     => $number_of_words,
                'symbols'   => $number_of_symbols
            ]
        ];
    }

    require 'view/layout.php';
}
else {
    require 'view/404.php';
}

