<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'app/core.php';
require 'app/Db.php';

if (!app\Db::is_database()) {
    app\Db::create_database();
}

$db = new \app\Db();
$table_name = 'messages';

if (!$db->is_table($table_name)) {
    $db->create_table($table_name);
    $db->fill_table($table_name, 25);
}

$messages_per_page  = 5;
$number_of_messages = $db->count($table_name);
$pages              = (int) ceil($number_of_messages / $messages_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
}
else {
    $page = (int) $_GET['page'];
}

if ($page <= $pages) {
    $data_for_page = $db->data_for_page($table_name, $page, $messages_per_page);
    require 'view/layout.php';
}
else {
    require 'view/404.php';
}