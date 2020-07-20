<?php

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require 'app/core.php';

$text = 'What is Symfony. Symfony is a set of PHP Components, a Web Application framework, a Philosophy, and a Community — all working together in harmony.
Symfony Framework. The leading PHP framework to create websites and web applications. Built on top of the Symfony Components.
Symfony Components. A set of decoupled and reusable components on which the best PHP applications are built, such as Drupal, phpBB, and eZ Publish.
Symfony Community. A passionate group of over 600,000 developers from more than 120 countries, all committed to helping PHP surpass the impossible.
Symfony Philosophy. Embracing and promoting professionalism, best practices, standardization and interoperability of applications.';

$paragraphs = explode("\r\n", $text);
$search_word            = 'Symfony';
$number_of_paragraphs   = count($paragraphs);
$number_of_sentences    = $number_of_paragraphs;
$number_of_words        = 0;
$number_of_symbols      = 0;
$number_of_matches      = 0;
$longest_words          = [mb_substr($text, 0, 1)];
$unique                 = [];
$result_text            = '';

foreach ($paragraphs as $paragraph) {
    $symbols = mb_count_chars($paragraph);
    foreach ($symbols as $symbol => $number) {
        if (isset($unique[$symbol]) == false) {
            $unique[$symbol] = 0;
        }
        $unique[$symbol] += $number;
    }
    $result_paragraph = '';

    while ($paragraph) {
        $symbol = mb_substr($paragraph, 0, 1);

        if (is_symbol_special($symbol) == false) {
            $word = get_word($paragraph);

            if (in_array($word, $longest_words) == false) {
                if (mb_strlen(strval($word)) > mb_strlen($longest_words[0])) {
                    $longest_words = [];
                    $longest_words[] = strval($word);
                }
                elseif (mb_strlen(strval($word)) == mb_strlen($longest_words[0])) {
                    $longest_words[] = strval($word);
                }
            }

            $number_of_words++;
            $number_of_symbols += mb_strlen($word);
            $paragraph = mb_substr($paragraph, mb_strlen($word));

            if (mb_strtolower($search_word) === mb_strtolower($word)) {
                $word = highlight_word($word);
                $number_of_matches++;
            }

            $result_paragraph .= $word;
        }
        else {
            if (is_end_of_sentence(mb_substr($paragraph, 0, 2)) == true) {
                $number_of_sentences++;
                $number_of_symbols += 2;
                $result_paragraph .= mb_substr($paragraph, 0, 2);
                $paragraph = mb_substr($paragraph, 2);
            }
            else {
                $result_paragraph .= $symbol;
                $number_of_symbols++;
                $paragraph = mb_substr($paragraph, 1);
            }
        }
    }
    $result_paragraph = '<p>' . $result_paragraph . '</p>';
    $result_text .= $result_paragraph;
}

ksort($unique, SORT_STRING);
unset($text);

require 'view/layout.php';