<?php
require "app/connection/tennis_cnf.php";
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $select = $_POST['select'];
    $phone = $_POST['phone'];
    $token = "6151514804:AAGk6pAtx-zsjN1QRXMQMQz9YMZ-MVBH1rQ";
    $chat_id = "-860516376";
    $arr = array(
        'Фамилия: ' => $surname,
        'Имя: ' => $name,
        'Отчество: ' => $patronymic,
        'Класс: ' => $select,
        'Телефон: ' => $phone,
    );

    if ($phone == Null):
        echo "error";
    else:
    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };
    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

    //убираем лишнее из номера
    $phone= str_replace([' ', '(', ')', '-'], '', $phone);
    // делаем проверку для записи id
    if ($select == 'любитель'):
    $select = 1;
    else:
    $select = 2;
    endif;
    //ввод данных из "записи" в таблицу users
        //ищем есть ли участник в базе
        $opt = $db->prepare("SELECT `phone` FROM `users`");
        $opt->execute(array());
        $value = $opt->fetchall(PDO::FETCH_ASSOC);
        foreach($value as $val){}
        //если есть то получаем его id
        if (in_array($phone, $val)):
            $opt = $db->prepare("SELECT `ID` FROM `users` WHERE `phone` = $phone");
            $opt->execute(array());
            $id_user = $opt->fetch(PDO::FETCH_COLUMN);
        else:
            $sql = "INSERT INTO `users` (`id`, `surname`, `name`, `patronymic`, `phone`, `id_class`) VALUES (NULL, '$surname', '$name', '$patronymic', ' $phone', '$select')";
            $query = $db->exec($sql);
            $opt = $db->prepare("SELECT `ID` FROM `users` WHERE `phone` = $phone");
            $opt->execute(array());
            $id_user = $opt->fetch(PDO::FETCH_COLUMN);
        endif;

    //автоматическая запись в сводную таблицу users_result_tour (участник + турнир)
    $opt = $db->prepare("SELECT ID FROM tournament WHERE ID = (SELECT MAX(ID) FROM tournament);");
    $opt->execute(array());
    $id_tour = $opt->fetch(PDO::FETCH_COLUMN);
    $sql = "INSERT INTO `users_result_tour` (`id`, `id_user`, `id_tournament`) VALUES (NULL, '$id_user', '$id_tour')";
    $query = $db->exec($sql);
    $db= null;
    endif;
?>
