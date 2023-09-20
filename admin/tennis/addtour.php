<?php
require "../../app/connection/tennis_cnf.php";
// Название турнира
$name_of_tour= $_POST['name_of_tour'];
//id категории
$cat = $_POST['categories'];
$category = $db->prepare("SELECT `id` FROM `categories` WHERE name='$cat'");
$category->execute(array());
$cat_val = $category->fetch(PDO::FETCH_COLUMN);
//id место прведения
$pls = $_POST['place'];
$place = $db->prepare("SELECT `id` FROM `place` WHERE name='$pls'");
$place->execute(array());
$pls_val = $place->fetch(PDO::FETCH_COLUMN);
//id адрес площадки
$add = $_POST['address'];
$address = $db->prepare("SELECT `id` FROM `address` WHERE name='$add'");
$address->execute(array());
$add_val = $address->fetch(PDO::FETCH_COLUMN);
//дата мероприятия
$data = $_POST['data'];
//время мероприятия
$time = $_POST['time'];
//взнос за участие
$price = $_POST['price'];
//id уровня игрока
$cls = $_POST['class'];
$class = $db->prepare("SELECT `id` FROM `class` WHERE name='$cls'");
$class->execute(array());
$cls_val = $class->fetch(PDO::FETCH_COLUMN);
//id организатор мероприятия
$org = $_POST['organizer'];
$organizer = $db->prepare("SELECT `id` FROM `organizer` WHERE name='$org'");
$organizer->execute(array());
$org_val = $organizer->fetch(PDO::FETCH_COLUMN);

$year = $_POST['year'];
//запрос на добавления (турнира) записи в tournament
$sql = "INSERT INTO `tournament` (`id`, `name_of_tour`, `id_categories`, `id_address`, `id_place`, `date`, `time`, `price`, `id_class`, `id_organizer`, `year`) VALUES (NULL, '$name_of_tour', '$cat_val', '$pls_val', '$add_val', '$data', '$time', '$price', '$cls_val', '$org_val', '$year')";
$query = $db->exec($sql);?>

<div class="good" style="display: flex; justify-content:centre;align-items: center;background:#ddd;">запись успешно добавлена</div>
<a class="btn btn-primary" style="width: 100px" href="./logout.php">Выйти</a>