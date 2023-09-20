<?php
require "../app/connection/tennis_cnf.php";
if(isset($_POST["list_id"])){
    $opt = $db->prepare("SELECT id_user FROM users_result_tour WHERE id_tournament = '".$_POST["list_id"]."'");
    $opt->execute(array());
    $value = $opt->fetchall(PDO::FETCH_ASSOC);
    foreach ($value as $row){
    ?>
        <li class="modal_list_item">
        <?php
           $opt = $db->prepare("SELECT `surname` FROM `users` WHERE ID = $row[id_user]");
           $opt->execute(array());
           $surname = $opt->fetch(PDO::FETCH_COLUMN);
           $opt = $db->prepare("SELECT `name` FROM `users` WHERE ID = $row[id_user]");
           $opt->execute(array());
           $name = $opt->fetch(PDO::FETCH_COLUMN);
           echo $surname,' ',$name;
        ?>
        </li>
    <?php }} ?>

