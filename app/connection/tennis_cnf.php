<?php
$config = array(
    'inst_url' => 'https://www.instagram.com/ontennis.ru/',
    'teleg_url' => 'https://t.me/ontennisru',
    'whats_url' => 'https://wa.me/+79500048474',

    'title' => 'real_tennis',
    );

    $db_host = "localhost";
    $db_user = "root"; // Логин БД
    $db_password = "root"; // Пароль БД
    $db_base = 'real_tennis'; // Имя БД

    $db = new PDO("mysql:host=$db_host;dbname=$db_base;charset=utf8mb4", $db_user, $db_password);

?>