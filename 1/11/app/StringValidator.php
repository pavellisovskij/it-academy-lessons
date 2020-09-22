<?php

namespace app;

class StringValidator extends MainValidator
{
    public function not_empty() {
        if (mb_strlen(trim($this->value)) != 0) return true;
        else return [
            "$this->field_name" => "Поле $this->field_name не может быть пустым"
        ];
    }

//    public function min() {
//        if (mb_strlen($this->value) >= $this->params['min']) return true;
//        else return [
//            "$this->field_name" => "Поле $this->field_name не может быть короче " . $this->params['min'] . " символов"
//        ];
//    }
//
//    public function max() {
//        if (mb_strlen($this->value) <= $this->params['max']) return true;
//        else return [
//            "$this->field_name" => "Поле $this->field_name не может быть длинее " . $this->params['max'] . " символов"
//        ];
//    }

    public function email() {
        $pattern = '/^[\w-]+@([\w-]+\.)+[\w-]+$/';
        $result = preg_match($pattern, $this->value);
        if ($result === 1) return true;
        elseif ($result === 0) return [
            "$this->field_name" => "Поле $this->field_name не является электронной почтой"
        ];
        else return [
            "$this->field_name" => "Ошибка ввода данных в поле $this->field_name. Обратитесь к администратору"
        ];
    }

    public function phone() {
        $pattern = '/^\(\d{2,2}\)\d{7,7}$/';
        $result = preg_match($pattern, $this->value);
        if ($result === 1) return true;
        elseif ($result === 0) return [
            "$this->field_name" => "Поле $this->field_name не валидно"
        ];
        else return [
            "$this->field_name" => "Ошибка ввода данных в поле $this->field_name. Обратитесь к администратору"
        ];
    }
}