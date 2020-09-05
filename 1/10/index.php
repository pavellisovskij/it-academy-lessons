<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'app/core.php';
require 'app/Db.php';
require 'app/Validator.php';

$db = new app\Db();

/**
 * Блок обработки данных формы
 */
if (!empty($_POST)) {
    $errors = [];
    $min = 3;
    $max = 25;
    $uploaddir = './images/';

    if (\app\Validator::is_string_empty($_POST['message'])) array_push($errors, 'Сообщение не может быть пустым');
    if (\app\Validator::is_string_less($_POST['user'], $min)) array_push($errors, "Имя пользователя не должно быть меньше $min символов");
    if (\app\Validator::is_string_larger($_POST['user'], $max)) array_push($errors, "Имя пользователя не должно быть больше $max символов");

    if (!empty($_FILES)) {
        foreach ($_FILES['images']['error'] as $error) {
            if ($error != 0) {
                array_push($errors, 'Что-то не так с загружаемым изображением');
            }
        }
    }

    if (empty($errors)) {
        $id = $db->add_message($_POST['user'], $_POST['message']);
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $file_extension = explode('.', $_FILES['images']['name'][$i]);
            $filename =  md5($_FILES['images']['name'][$i] . '_' . time()) . '.' . end($file_extension);
            move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploaddir . $filename);
            $db->add_image($id, $filename);
        }
    }
}

/**
 * Блок вывода сообщений
 */
$messages_per_page  = 5;
$number_of_messages = $db->count();
$pages              = (int) ceil($number_of_messages / $messages_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
}
else {
    $page = (int) $_GET['page'];
}

if ($page <= $pages) {
    $data_for_page = $db->data_for_page($page, $messages_per_page);
    require 'view/layout.php';
}
else {
    require 'view/404.php';
}