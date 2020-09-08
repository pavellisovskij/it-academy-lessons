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
    $validation_errors  = [];
    $image_errors       = [];
    $bad_data           = [];
    $min                = 3;
    $max                = 25;
    $uploaddir          = './images/';

    if (\app\Validator::is_string_empty($_POST['message'])) array_push($validation_errors, 'Сообщение не может быть пустым');
    if (\app\Validator::is_string_less($_POST['user'], $min)) array_push($validation_errors, "Имя пользователя не должно быть меньше $min символов");
    if (\app\Validator::is_string_larger($_POST['user'], $max)) array_push($validation_errors, "Имя пользователя не должно быть больше $max символов");

//    debug($_FILES);
    if (!empty($_FILES) && $_FILES['images']['name'][0] != '') {
        foreach ($_FILES['images']['error'] as $error) {
            if ($error != 0) {
                array_push($image_errors, 'Что-то не так с загружаемым изображением');
            }
        }
    }

    $errors = array_merge($validation_errors, $image_errors);

    if (empty($errors)) {
        $message_id = $db->add_message($_POST['user'], $_POST['message']);
        if (!empty($_FILES) && $_FILES['images']['name'][0] != '') {
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                $image_id = $db->add_image($message_id);
                $file_extension = explode('.', $_FILES['images']['name'][$i]);
                $filename = (string) $image_id . '_' . time() . '.' . end($file_extension);
                $db->set_new_image_name($image_id, $filename);
                move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploaddir . $filename);
            }
        }
    }
    else {
        foreach ($_POST as $key => $value) {
            $bad_data[$key] = $value;
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