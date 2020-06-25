<?php

$x = 10;

echo '<h3>Task 1</h3>';

if ($x > 0) {
    $color = 'green';
} elseif ($x == 0) {
    $color = 'yellow';
} elseif ($x < 0) {
    $color = 'red';
}

echo "<p style='color: $color'>$x</p>";