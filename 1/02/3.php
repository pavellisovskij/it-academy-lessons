<?php

echo '<h3>Task 3</h3>';

$a = -6;
$b = 5;
$c = 7;
$d = 1;
$max = null;

echo "<p>a=$a; b=$b; c=$c; d=$d.</p>";

if ($a > $b && $a > $c && $a > $d) {
    $max = $a;
} elseif ($b > $a && $b > $c && $b > $d) {
    $max = $b;
} elseif ($c > $a && $c > $b && $c > $d) {
    $max = $c;
} elseif ($d > $a && $d > $c && $d > $b) {
    $max = $d;
}

echo '<p>Среди четырех чисел найбольшее = ' . $max . '.</p>';