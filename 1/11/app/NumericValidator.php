<?php

namespace app;

class NumericValidator extends MainValidator
{
    public const STRING_EMPTY   = 'is_string_empty';
    public const STRING_LESS    = 'is_string_less';
    public const STRING_LARGER  = 'is_string_larger';

    public static function is_string_empty(string $str) {
        if (mb_strlen(trim($str)) == 0) return true;
        else return false;
    }

    public static function is_string_less(string $str, int $min) {
        if (mb_strlen($str) < $min) return true;
        else return false;
    }

    public static function is_string_larger(string $str, int $max) {
        if (mb_strlen($str) > $max) return true;
        else return false;
    }
}