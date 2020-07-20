<!doctype html>
<html lang=ru>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Решение задач по теме "Строковые функции. Пользовательские функции."</title>
    </head>
    <body>
        <h5>
            <b>Задание 1.</b> Определить, сколько раз встречается в тексте слово Symfony и вывести
            текст, выделив его в тексте цветом.
        </h5>
        <br>
        <?= $result_text ?>
        <p>Количество повторений слова "<b><?= $search_word ?></b>" равняется <b><?= $number_of_matches ?></b>.</p>
        <hr>

        <h5>
            <b>Задание 2.</b> Вывести в браузер статистику файла – количество абзацев, предложений,
            слов, символов.
        </h5>
        <p>Статистика файла:</p>
        <p>абзацев: <?= $number_of_paragraphs ?></p>
        <p>предложений: <?= $number_of_sentences ?></p>
        <p>слов: <?= $number_of_words ?></p>
        <p>символов: <?= $number_of_symbols ?></p>
        <hr>

        <h5>
            <b>Задание 3.</b> Найти самое длинное слово. Если таких несколько, вывести в браузер их
            все.
        </h5>
        <ul>
            <?php foreach ($longest_words as $word) : ?>
                <li>
                    <?= $word ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <hr>

        <h5>
            <b>Задание 4.</b> Для каждого символа, имеющегося в тексте подсчитать, сколько раз он там
            встречается, символы расположить в возрастающем порядке.
        </h5>
        <ol>
            <?php foreach ($unique as $symbol => $number) : ?>
                <li>
                    Символ "<b><?= $symbol ?></b>" встречается <b><?= $number ?></b> раз.
                </li>
            <?php endforeach; ?>
        </ol>
    </body>
</html>