<?php

echo '<h3>Task 2</h3>';

$a = 2;
$b = 3;
$c = 1;
$min = $a;
$max = $a;

if ($a <= $min) {
    $min = $a;
} elseif ($a >= $max) {
    $max = $a;
}

if ($b <= $min) {
    $min = $b;
} elseif ($b >= $max) {
    $max = $b;
}

if ($c <= $min) {
    $min = $c;
} elseif ($c >= $max) {
    $max = $c;
}

$sum = $min + $max;
echo '<p>Сумма максимального и минимального чисел = ' . $sum . '</p>';