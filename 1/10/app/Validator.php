<?php

namespace app;

class Validator
{
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