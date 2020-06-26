<?php

echo '<h3>Task 4</h3>';

$length = 30;
$width  = 25;
$height = 20;

$bag_length = 20;
$bag_width  = 30;
$bag_height = 30;

echo '<p>Размеры объектов: <b>длина</b> х <b>ширина</b> х <b>высота</b>.</p>';
echo "<p>Размеры товара:  $length х $width х $height.</p>";
echo "<p>Размеры сумки:  $bag_length х $bag_width х $bag_height.</p>";


if (
    ($length <= $bag_length && $width <= $bag_width && $height <= $bag_height)
    || (
        ($length <= $bag_length || $length <= $bag_width || $length <= $bag_height)
        && ($width <= $bag_width || $width <= $bag_height || $width <= $bag_length)
        && ($height <= $bag_height || $height <= $bag_length || $height <= $bag_width)
    )
) {
    echo '<p style="color: green;">Товар можно упаковать в сумку.</p>';
} else {
    echo '<p style="color: red;">Товар не помещается в сумку.</p>';
}