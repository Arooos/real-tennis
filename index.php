<?php
    require "app/connection/tennis_cnf.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="shortcut icon" href="icons/tennis/tennis.ico">
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:wght@400;500;600;700&family=Bayon&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.min.css">
    

    <title><?php echo $config['title']; ?></title>
</head>
<body class="body">
    
    <?php include "app/includes/header.php";?>
    <section class="promo" id="promo">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-0 col-md-5 offset-md-0 col-sm-6 offset-sm-3">
                    <h1 class="promo_logo"><?php echo $config['title']; ?></h1>
                    <div class="promo_descr">Серия любительских<br>теннисный турниров<br>в Санкт-Петербурге</div>
                    <div class="social">
                        <a href="<?php echo $config['inst_url'] ?>" class="social_link">instagram</a>
                        <a href="<?php echo $config['teleg_url'] ?>" class="social_link">telegram</a>
                        <a href="<?php echo $config['whats_url'] ?>" class="social_link">whatsapp</a>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <section class="anons" id="anons">
                    <?php
                        $opt = $db->prepare("SELECT * FROM tournament WHERE ID = (SELECT MAX(ID) FROM tournament);");
                        $opt->execute(array());
                        $value = $opt->fetchall(PDO::FETCH_ASSOC);
                        foreach($value as $val){
                    ?>
                        <div class="nearest">
                            <div class="title nearest_title">БЛИЖАЙШИЙ ТУРНИР</div>
                            <div class="nearest_address">
                                <?php 
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM place WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                    <br>
                                <?php 
                                    $dt = $val["id_address"];
                                    $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                            </div>
                            <div class="nearest_date">
                            <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                            <div class="nearest_categories">
                                <?php 
                                    $dt = $val["id_categories"];
                                    $opt = $db->prepare("SELECT `name` FROM `categories` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                            </div>
                            <div class="nearest_data">ОРГАНИЗАТОР:<span>
                                <?php 
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"],' ',$result_row["patronymic"];
                                    }
                                ?>
                                </span><br> РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                    <?php 
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                    
                                    ?>
                                </span></div> 
                            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-10 offset-1">
                                <div class="nearest_btn">
                                    <button data-modal="tournament" class="nearest_btn_1 btn bg_block">записаться</button>
                                    <button data-modal="particip" id="<?php echo $val["id"];?>" class="nearest_btn_2 btn bg_block">участники</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div> 
                    </section>
                </div>
            </div>
        </div>
    </section>
    

    <section class="categories" id="categories">
        <?php
            $opt = $db->prepare("SELECT CURDATE()");
            $opt->execute(array());
            $date_now = $opt->fetch(PDO::FETCH_COLUMN);
        ?>
        <div class="container">
            <div class="title categories_title">Анонс Ближайших Турниров</div>
            <div class="row">
                <div class="col-md-4">
                    <!-- цикл для вывода актуальных турниров ( которые не актуальной/сегодняшней даты) -->
                    <?php 
                        $opt = $db->prepare("SELECT `date` FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 1)");
                        $opt->execute(array());
                        $date_tour = $opt->fetch(PDO::FETCH_COLUMN);
                        if ($date_now < $date_tour):
                    ?>
                    <div class="main">
                            <?php
                                //выбока самой поздней записи из турниров где категория МУЖСКАЯ ОДИНОЧКА id=11 
                                $opt = $db->prepare("SELECT * FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 1);");
                                $opt->execute(array());
                                $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                foreach($value as $val){
                            ?>
                        <div class="front">
                            <img src="img/tennis/categories/man1.png" alt="" class="categories_front_img">
                            <div class="categories_front">
                                <div class="categories_front_title">МУЖСКОЙ <br> ОДИНОЧНЫЙ ТУРНИР</div>
                                <div class="categories_front_inf">ДАТЫ:</div>
                                <div class="categories_front_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="categories_front_inf">ОРГАНИЗАТОР:</div>
                                <div class="categories_front_org">
                                <!-- вывод организатора -->
                                <?php
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"],' ',$result_row["patronymic"];
                                    }?>
                                </div>
                                <div class="categories_front_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="categories_back">
                                <div class="categories_back_title">МУЖСКОЙ <br> ОДИНОЧНЫЙ ТУРНИР</div>
                                <div class="categories_back_address">
                                <!-- вывод места -->
                                <?php
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM `place` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                <br>
                                <!-- вывод адреса -->
                                <?php
                                   $dt = $val["id_address"];
                                   $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                   $opt->execute(array());
                                   $value = $opt->fetch(PDO::FETCH_COLUMN);
                                   echo $value;
                                ?>
                                </div>
                                <div class="categories_back_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="categories_back_data">РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                <!-- вывод уровня игрока -->
                                <?php
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                ?></span></div>                                
                            </div>
                                <?php }?>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="main">
                        <div class="front">
                            <img src="img/tennis/categories/man1.png" alt="" class="categories_front_img">
                            <div class="categories_front">
                                <div class="categories_front_title">МУЖСКОЙ <br> ОДИНОЧНЫЙ ТУРНИР</div>
                                <div class="categories_front_inf">ДАТЫ:</div>
                                <div class="categories_front_near">СКОРО</div>
                                <div class="categories_front_inf">ОРГАНИЗАТОР:</div>
                                <div class="categories_front_org">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="categories_front_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="categories_back">
                                <div class="categories_back_title">МУЖСКОЙ <br> ОДИНОЧНЫЙ ТУРНИР</div>
                                <div class="categories_back_address">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="categories_back_near_else">СКОРО</div>
                                <div class="categories_back_data">РЕГЛАМЕНТ: <span>УТОЧНЯЕТСЯ</span></div>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                </div>
                <div class="col-md-4">
                    <!-- цикл для вывода актуальных турниров ( которые не актуальной/сегодняшней даты) -->
                    <?php 
                        $opt = $db->prepare("SELECT `date` FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 2)");
                        $opt->execute(array());
                        $date_tour = $opt->fetch(PDO::FETCH_COLUMN);
                        if ($date_now < $date_tour):
                    ?>
                    <div class="main">
                                <?php
                                    //выбока самой поздней записи из турниров где категория МУЖСКАЯ ОДИНОЧКА id=2
                                    $opt = $db->prepare("SELECT * FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 2);");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach($value as $val){
                                ?>
                        <div class="front">
                            <img src="img/tennis/categories/man2.png" alt="" class="categories_front_img">
                            <div class="categories_front">
                                <div class="categories_front_title">женский <br> одиночный турнир</div>
                                <div class="categories_front_inf">ДАТЫ:</div>
                                <div class="categories_front_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="categories_front_inf">ОРГАНИЗАТОР:</div>
                                <div class="categories_front_org">
                                <?php
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"],' ',$result_row["patronymic"];
                                    }?>
                                </div>
                                <div class="categories_front_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="categories_back">
                                <div class="categories_back_title">женский <br> одиночный турнир</div>
                                <div class="categories_back_address">
                                <!-- вывод места -->
                                <?php
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM `place` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                <br>
                                <!-- вывод адреса -->
                                <?php
                                $dt = $val["id_address"];
                                $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                $opt->execute(array());
                                $value = $opt->fetch(PDO::FETCH_COLUMN);
                                echo $value;
                                ?>
                                </div>
                                <div class="categories_back_near">
                                    <?php
                                        $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                        $class->execute(array());
                                        $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                        $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                        $date->execute(array());
                                        $day = $date->fetch(PDO::FETCH_COLUMN);
                                            $date=explode(".", date("m"));
                                            switch ($mouth){
                                            case 1: $m='января'; break;
                                            case 2: $m='февраля'; break;
                                            case 3: $m='марта'; break;
                                            case 4: $m='апреля'; break;
                                            case 5: $m='мая'; break;
                                            case 6: $m='июня'; break;
                                            case 7: $m='июля'; break;
                                            case 8: $m='августа'; break;
                                            case 9: $m='сентября'; break;
                                            case 10: $m='октября'; break;
                                            case 11: $m='ноября'; break;
                                            case 12: $m='декабря'; break;
                                            }
                                            echo $day.'&nbsp;'.$m;
                                    ?> В <?php 
                                        $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                        $class->execute(array());
                                        $time = $class->fetch(PDO::FETCH_COLUMN);
                                        echo $time;
                                    ?></div>
                                <div class="categories_back_data">РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                    <!-- вывод уровня игрока -->
                                <?php
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                ?>
                                </span></div>                                
                            </div>
                                <?php }?>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="main">
                        <div class="front">
                            <img src="img/tennis/categories/man2.png" alt="" class="categories_front_img">
                            <div class="categories_front">
                                <div class="categories_front_title">женский <br> одиночный турнир</div>
                                <div class="categories_front_inf">ДАТЫ:</div>
                                <div class="categories_front_near">СКОРО</div>
                                <div class="categories_front_inf">ОРГАНИЗАТОР:</div>
                                <div class="categories_front_org">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="categories_front_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="categories_back">
                                <div class="categories_back_title">женский <br> одиночный турнир</div>
                                <div class="categories_back_address">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="categories_back_near_else">СКОРО</div>
                                <div class="categories_back_data">РЕГЛАМЕНТ: <span>УТОЧНЯЕТСЯ</span></div>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                </div>
                <div class="col-md-4">
                        <!-- цикл для вывода актуальных турниров ( которые не актуальной/сегодняшней даты) -->
                        <?php 
                            $opt = $db->prepare("SELECT `date` FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 3)");
                            $opt->execute(array());
                            $date_tour = $opt->fetch(PDO::FETCH_COLUMN);
                            if ($date_now < $date_tour):
                        ?>
                    <div class="main">
                            <?php
                                //выбока самой поздней записи из турниров где категория МУЖСКАЯ ОДИНОЧКА id=3
                                $opt = $db->prepare("SELECT * FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 3);");
                                $opt->execute(array());
                                $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                foreach($value as $val){
                            ?>
                        <div class="front">
                            <img src="img/tennis/categories/woman2.png" alt="" class="categories_front_img">
                            <div class="categories_front">
                                <div class="categories_front_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="categories_front_inf">ДАТЫ:</div>
                                <div class="categories_front_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="categories_front_inf">ОРГАНИЗАТОР:</div>
                                <div class="categories_front_org">
                                <?php
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"],' ',$result_row["patronymic"];
                                    }?>
                                </div>
                                <div class="categories_front_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="categories_back">
                                <div class="categories_back_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="categories_back_address">
                                <!-- вывод места -->
                                <?php
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM `place` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                <br>
                                <!-- вывод адреса -->
                                <?php
                                $dt = $val["id_address"];
                                $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                $opt->execute(array());
                                $value = $opt->fetch(PDO::FETCH_COLUMN);
                                echo $value;
                                ?>
                                </div>
                                <div class="categories_back_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="categories_back_data">РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                    <!-- вывод уровня игрока -->
                                <?php
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                ?>
                                </span></div>                                
                            </div>
                            <?php }?>
                        </div>
                    </div>
                        <?php else:?>
                    <div class="main">
                        <div class="front">
                            <img src="img/tennis/categories/woman2.png" alt="" class="categories_front_img">
                            <div class="categories_front">
                                <div class="categories_front_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="categories_front_inf">ДАТЫ:</div>
                                <div class="categories_front_near">СКОРО</div>
                                <div class="categories_front_inf">ОРГАНИЗАТОР:</div>
                                <div class="categories_front_org">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="categories_front_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="categories_back">
                                <div class="categories_back_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="categories_back_address">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="categories_back_near_else">СКОРО</div>
                                <div class="categories_back_data">РЕГЛАМЕНТ: <span>УТОЧНЯЕТСЯ</span></div>
                            </div>
                        </div>
                    </div>
                        <?php endif?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="categories_sm" id="categories_sm">
        <div class="container">
            <div class="wrapper">
                <div class="item">
                    <!-- цикл для вывода актуальных турниров ( которые не актуальной/сегодняшней даты) -->
                    <?php 
                        $opt = $db->prepare("SELECT `date` FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 1)");
                        $opt->execute(array());
                        $date_tour = $opt->fetch(PDO::FETCH_COLUMN);
                        if ($date_now < $date_tour):
                    ?>
                    <div class="main">
                        <?php
                            //выбока самой поздней записи из турниров где категория МУЖСКАЯ ОДИНОЧКА id=11 
                            $opt = $db->prepare("SELECT * FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 1);");
                            $opt->execute(array());
                            $value = $opt->fetchall(PDO::FETCH_ASSOC);
                            foreach($value as $val){
                        ?>
                        <div class="front">
                            <img src="img/tennis/categories/man2.png" alt="" class="front_item_img">
                            
                            <div class="front_item">
                                <div class="front_item_title">МУЖСКОЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="front_item_inf">ДАТЫ:</div>
                                <div class="front_item_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="front_item_inf">ОРГАНИЗАТОР:</div>
                                <div class="front_item_org">
                                <!-- вывод организатора -->
                                <?php
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"]?><br><?php echo $result_row["patronymic"];
                                    }?>
                                </div>
                                <div class="front_item_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="back_item">
                                <div class="back_item_title">МУЖСКОЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="back_item_address">
                                <!-- вывод места -->
                                <?php
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM `place` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                <br>
                                <!-- вывод адреса -->
                                <?php
                                   $dt = $val["id_address"];
                                   $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                   $opt->execute(array());
                                   $value = $opt->fetch(PDO::FETCH_COLUMN);
                                   echo $value;
                                ?>
                                </div>
                                <div class="back_item_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="back_item_data">РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                <!-- вывод уровня игрока -->
                                <?php
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                ?></span></div>                                
                            </div>
                                <?php }?>
                        </div>        
                    </div>
                    <?php else:?>
                    <div class="main">
                        <div class="front">
                            <img src="img/tennis/categories/man1.png" alt="" class="front_item_img">
                            <div class="front_item">
                                <div class="front_item_title">МУЖСКОЙ <br> ОДИНОЧНЫЙ ТУРНИР</div>
                                <div class="front_item_inf">ДАТЫ:</div>
                                <div class="front_item_near">СКОРО</div>
                                <div class="front_item_inf">ОРГАНИЗАТОР:</div>
                                <div class="front_item_org">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="front_item_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="back_item">
                                <div class="back_item_title">МУЖСКОЙ <br> ОДИНОЧНЫЙ ТУРНИР</div>
                                <div class="back_item_address">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="back_item_near_else">СКОРО</div>
                                <div class="back_item_data">РЕГЛАМЕНТ: <span>УТОЧНЯЕТСЯ</span></div>
                                <div class="back_item_btn">
                                    <button data-modal="tournament" class="back_item_btn_1 btn bg_block">записаться</button>
                                    <button data-modal="participants" class="back_item_btn_2 btn bg_block">участники</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                </div>
                <div class="item">
                    <!-- цикл для вывода актуальных турниров ( которые не актуальной/сегодняшней даты) -->
                    <?php 
                        $opt = $db->prepare("SELECT `date` FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 2)");
                        $opt->execute(array());
                        $date_tour = $opt->fetch(PDO::FETCH_COLUMN);
                        if ($date_now < $date_tour):
                    ?>
                    <div class="main">
                        <?php
                            //выбока самой поздней записи из турниров где категория МУЖСКАЯ ПАРА id=2
                            $opt = $db->prepare("SELECT * FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 2);");
                            $opt->execute(array());
                            $value = $opt->fetchall(PDO::FETCH_ASSOC);
                            foreach($value as $val){
                        ?>
                        <div class="front">
                            <img src="img/tennis/categories/man2.png" alt="" class="front_item_img">
                            
                            <div class="front_item">
                                <div class="front_item_title">женский <br> одиночный турнир</div>
                                <div class="front_item_inf">ДАТЫ:</div>
                                <div class="front_item_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="front_item_inf">ОРГАНИЗАТОР:</div>
                                <div class="front_item_org">
                                <!-- вывод организатора -->
                                <?php
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"]?><br><?php echo $result_row["patronymic"];
                                    }?>
                                </div>
                                <div class="front_item_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="back_item">
                                <div class="back_item_title">женский <br> одиночный турнир</div>
                                <div class="back_item_address">
                                <!-- вывод места -->
                                <?php
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM `place` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                <br>
                                <!-- вывод адреса -->
                                <?php
                                   $dt = $val["id_address"];
                                   $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                   $opt->execute(array());
                                   $value = $opt->fetch(PDO::FETCH_COLUMN);
                                   echo $value;
                                ?>
                                </div>
                                <div class="back_item_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="back_item_data">РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                <!-- вывод уровня игрока -->
                                <?php
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                ?></span></div>                                
                            </div>
                                <?php }?>
                        </div>        
                    </div>
                    <?php else:?>
                    <div class="main">
                        <div class="front">
                            <img src="img/tennis/categories/man2.png" alt="" class="front_item_img">
                            <div class="front_item">
                                <div class="front_item_title">женский <br> одиночный турнир</div>
                                <div class="front_item_inf">ДАТЫ:</div>
                                <div class="front_item_near">СКОРО</div>
                                <div class="front_item_inf">ОРГАНИЗАТОР:</div>
                                <div class="front_item_org">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="front_item_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="back_item">
                                <div class="back_item_title">женский <br> одиночный турнир</div>
                                <div class="back_item_address">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="back_item_near_else">СКОРО</div>
                                <div class="back_item_data">РЕГЛАМЕНТ: <span>УТОЧНЯЕТСЯ</span></div>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                </div>
                <div class="item">
                    <!-- цикл для вывода актуальных турниров ( которые не актуальной/сегодняшней даты) -->
                    <?php 
                        $opt = $db->prepare("SELECT `date` FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 3)");
                        $opt->execute(array());
                        $date_tour = $opt->fetch(PDO::FETCH_COLUMN);
                        if ($date_now < $date_tour):
                    ?>
                    <div class="main">
                        <?php
                            //выбока самой поздней записи из турниров где категория МУЖСКАЯ ОДИНОЧКА id=7
                            $opt = $db->prepare("SELECT * FROM `tournament` WHERE ID = (SELECT MAX(ID) FROM `tournament` WHERE id_categories = 3);");
                            $opt->execute(array());
                            $value = $opt->fetchall(PDO::FETCH_ASSOC);
                            foreach($value as $val){
                        ?>
                        <div class="front">
                            <img src="img/tennis/categories/woman2.png" alt="" class="front_item_img">
                            <div class="front_item">
                                <div class="front_item_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="front_item_inf">ДАТЫ:</div>
                                <div class="front_item_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="front_item_inf">ОРГАНИЗАТОР:</div>
                                <div class="front_item_org">
                                <!-- вывод организатора -->
                                <?php
                                    $dt = $val["id_organizer"];
                                    $opt = $db->prepare("SELECT `surname`,`name`,`patronymic` FROM `organizer` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetchall(PDO::FETCH_ASSOC);
                                    foreach ($value as $result_row){
                                        echo $result_row["surname"],' ',$result_row["name"]?><br><?php echo $result_row["patronymic"];
                                    }?>
                                </div>
                                <div class="front_item_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div> 
                        <div class="back">
                            <div class="back_item">
                                <div class="back_item_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="back_item_address">
                                <!-- вывод места -->
                                <?php
                                    $dt = $val["id_place"];
                                    $opt = $db->prepare("SELECT `name` FROM `place` WHERE ID = $dt;");
                                    $opt->execute(array());
                                    $value = $opt->fetch(PDO::FETCH_COLUMN);
                                    echo $value;
                                ?>
                                <br>
                                <!-- вывод адреса -->
                                <?php
                                   $dt = $val["id_address"];
                                   $opt = $db->prepare("SELECT `name` FROM `address` WHERE ID = $dt;");
                                   $opt->execute(array());
                                   $value = $opt->fetch(PDO::FETCH_COLUMN);
                                   echo $value;
                                ?>
                                </div>
                                <div class="back_item_near">
                                <?php
                                    $class = $db->prepare("SELECT MONTH(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $class->execute(array());
                                    $mouth = $class->fetch(PDO::FETCH_COLUMN);
                                    $date = $db->prepare("SELECT DAY(`date`) FROM `tournament` WHERE id=$val[id]");
                                    $date->execute(array());
                                    $day = $date->fetch(PDO::FETCH_COLUMN);
                                        $date=explode(".", date("m"));
                                        switch ($mouth){
                                        case 1: $m='января'; break;
                                        case 2: $m='февраля'; break;
                                        case 3: $m='марта'; break;
                                        case 4: $m='апреля'; break;
                                        case 5: $m='мая'; break;
                                        case 6: $m='июня'; break;
                                        case 7: $m='июля'; break;
                                        case 8: $m='августа'; break;
                                        case 9: $m='сентября'; break;
                                        case 10: $m='октября'; break;
                                        case 11: $m='ноября'; break;
                                        case 12: $m='декабря'; break;
                                        }
                                        echo $day.'&nbsp;'.$m;
                                ?> В <?php 
                                    $class = $db->prepare("SELECT DATE_FORMAT(`time`,'%H:%i') FROM tournament WHERE id=$val[id]");
                                    $class->execute(array());
                                    $time = $class->fetch(PDO::FETCH_COLUMN);
                                    echo $time;
                                ?></div>
                                <div class="back_item_data">РЕГЛАМЕНТ: <span>ДОПУСКАЮТСЯ ИГРОКИ
                                <!-- вывод уровня игрока -->
                                <?php
                                    $dt = $val["id_class"];
                                    if ($dt==1):
                                        echo "любители";
                                    else:
                                        echo "профессионалы";
                                    endif;
                                ?></span></div>                                
                            </div>
                                <?php }?>
                        </div>        
                    </div>
                    <?php else:?>
                    <div class="main">
                        <div class="front">
                            <img src="img/tennis/categories/woman2.png" alt="" class="front_item_img">
                            <div class="front_item">
                                <div class="front_item_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="front_item_inf">ДАТЫ:</div>
                                <div class="front_item_near">СКОРО</div>
                                <div class="front_item_inf">ОРГАНИЗАТОР:</div>
                                <div class="front_item_org">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="front_item_next"><img src="icons/next_svg.svg" alt="up" ></div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="back_item">
                                <div class="back_item_title">СМЕШАННЫЙ <br> ПАРНЫЙ ТУРНИР</div>
                                <div class="back_item_address">ИНФОРМАЦИЯ СКОРО ПОЯВИТСЯ</div>
                                <div class="back_item_near_else">СКОРО</div>
                                <div class="back_item_data">РЕГЛАМЕНТ: <span>УТОЧНЯЕТСЯ</span></div>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                </div>
            </div>
        </div>  
    </section>
        
    <section class="courts" id="courts">
        <div class="carousel">
            <div class="container">
                <div class="title">корты</div>
                <div class="carousel__inner">
                    <div>
                        <img src="img/tennis/courts/sestr.png" alt="">
                        <a href="https://skrazliv.com/"><div class="carousel__inner__title">
                        <?php
                        $sth = $db->prepare("SELECT `name` FROM `address` WHERE id=1");
                        $sth->execute(array());
                        $value = $sth->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                        ?>
                        </div></a>
                    </div>
                    <div>
                        <img src="img/tennis/courts/sestr2.png" alt="">
                        <a href="https://parkdubki.ru/спорт/теннисный-клуб/"><div class="carousel__inner__title">
                        <?php
                        $sth = $db->prepare("SELECT `name` FROM `address` WHERE id=2");
                        $sth->execute(array());
                        $value = $sth->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                        ?></div></a>
                    </div>
                    <div>
                        <img src="img/tennis/courts/energy.png" alt="">
                        <a href="https://energyarena.ru/"><div class="carousel__inner__title">
                        <?php
                        $sth = $db->prepare("SELECT `name` FROM `address` WHERE id=3");
                        $sth->execute(array());
                        $value = $sth->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                        ?>
                        </div></a>
                    </div>
                    <div>
                        <img src="img/tennis/courts/lisiy.png" alt="">
                        <a href="https://pmisport.ru/"><div class="carousel__inner__title">
                        <?php
                        $sth = $db->prepare("SELECT `name` FROM `address` WHERE id=4");
                        $sth->execute(array());
                        $value = $sth->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                        ?>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history" id="history">
        <div class="title">ИСТОРИЯ НАШИХ ТУРНИРОВ</div>
            <div class="container">
                <div class="slider">
                    <div class="slider-block">
                        <div class="slider-wrapper">
                            <button data-modal="modal_tour" class="slider-wrapper-item braun bg_block" id="2023">2023</button>
                        </div>
                    </div>
                    <div class="slider-block">
                        <div class="slider-wrapper">
                            <button data-modal="modal_tour" class="slider-wrapper-item orange bg_block" id="2022">2022</button>
                        </div>
                    </div>
                    <div class="slider-block">
                        <div class="slider-wrapper">
                            <button data-modal="modal_tour" class="slider-wrapper-item red bg_block" id="2021">2021</button>
                        </div>
                    </div>
                    <div class="slider-block">
                        <div class="slider-wrapper">
                            <button data-modal="modal_tour" class="slider-wrapper-item braun bg_block" id="2020">2020</button>
                        </div>
                    </div>
                    <div class="slider-block">
                        <div class="slider-wrapper">
                            <button data-modal="modal_tour" class="slider-wrapper-item orange bg_block" id="2019">2019</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                    

     <section class="history_sm" id="history_sm">
        <div class="title">ИСТОРИЯ НАШИХ ТУРНИРОВ</div>
        <div class="container">       
            <div class="wrap">
                <div class="it">
                    <button data-modal="modal_tour" class="it_btn orange bg_block" id="2019">2019</button>
                </div>
                <div class="it">
                    <button data-modal="modal_tour" class="it_btn braun bg_block" id="2020">2020</button>
                </div>
                <div class="it">
                    <button data-modal="modal_tour" class="it_btn red bg_block" id="2021">2021</button>
                </div>
                <div class="it">
                    <button data-modal="modal_tour" class="it_btn orange bg_block" id="2022">2022</button>
                </div>
                <div class="it">
                    <button data-modal="modal_tour" class="it_btn braun bg_block" id="2023">2023</button>
                </div>
            </div>
        </div>
    </section>

    <section class="sing" id="sing">
        <div class="container">
            <div class="bg_sing">
                <div class="wrapp">
                    <div class="sing_title">ЗАПИШИСЬ НА <span>ИНДИВИДУАЛЬНУЮ</span>/<span>ГРУППОВУЮ</span> ТРЕНИРОВКУ</div>
                    <div>
                        <ul class="sing_descr">
                            <li>Наши тренировки проходят каждый день.</li>
                            <li>Все тренировки проходят с тренером.</li>
                            <li>Спарринг подбирается под уровень игрока.</li>
                        </ul>
                    </div>
                    <div class="sing_tipe"><span>ИНДИВИДУАЛЬНАЯ</span> ТРЕНИРОВКА - 2.000 РУБ./ЧАС<br><span>ГРУППОВАЯ</span> ТРЕНИРОВКА - 1.500 РУБ./ЧАС</div>
                </div>
                
                <button data-modal="workout" class="sing_btn btn bg_block">записаться</button>
            </div>
        </div>    
    </section>

    <section class="partner" id="anons">
        <div class="container">
            <div class="row">
                <div class="col-md-12 offset-md-0 col-sm-10 offset-sm-1">
                    <div class="list">
                        <div class="title">ПАРТНЁРЫ</div>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <a class="partner_link" href="#">
                                    <img class="partner_link_icons" src="img/tennis/partners/port_artyr.png" alt="">
                                </a>
                            </div>
                            <div class="col-md-3 col-6">
                                <a class="partner_link" href="#">
                                    <img class="partner_link_icons" src="img/tennis/partners/EA.png" alt="">
                                </a>
                            </div>
                            <div class="col-md-3 col-6">
                                <a class="partner_link" href="#">
                                    <img class="partner_link_icons" src="img/tennis/partners/dae.svg" alt="">
                                </a>
                            </div>
                            <div class="col-md-3 col-6">
                                <a class="partner_link" href="#">
                                    <img class="partner_link_icons" src="img/tennis/partners/chistayaline.png" alt="">
                                </a>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>     
    </section>

    
    <?php include "app/includes/footer.php"; ?>
    

    <section class="overlay" id="overlay">
        <div class="modal" id="tournament">
            <div class="modal_close">&times;</div>
            <div class="modal_title">ЗАПИСАТЬСЯ НА ТУРНИР</div>
            <div class="modal_name">ОРГАНИЗАТОР</div>
            <div class="modal_org">ОСИПОВ СЕРГЕЙ ВЛАДИСЛАВОВИЧ<br>+7(950)004-84-74</div>
            <form class="feed-form" id="feed-form" action="db_teleg.php" method="post">
                <input id="surname" name="surname" placeholder="Фамилия" type="text">
                <input id="name" name="name" placeholder="Имя" type="text">
                <input id="patronymic" name="patronymic" placeholder="Отчество" type="text">
                <input id="phone" name="phone" type="tel" placeholder="Телефон">
                <div class="form-group">
                    <select name="select" class="select">
                        <option value="<?php 
                                $sth = $db->prepare("SELECT `name` FROM `class` WHERE id=1");
                                $sth->execute(array());
                                $value = $sth->fetch(PDO::FETCH_COLUMN);
                                echo $value;
                            ?>"><?php 
                            $sth = $db->prepare("SELECT `name` FROM `class` WHERE id=1");
                            $sth->execute(array());
                            $value = $sth->fetch(PDO::FETCH_COLUMN);
                            echo $value;
                        ?></option>
                        <option value="<?php 
                                $sth = $db->prepare("SELECT `name` FROM `class` WHERE id=2");
                                $sth->execute(array());
                                $value = $sth->fetch(PDO::FETCH_COLUMN);
                                echo $value;
                            ?>"><?php 
                            $sth = $db->prepare("SELECT `name` FROM `class` WHERE id=2");
                            $sth->execute(array());
                            $value = $sth->fetch(PDO::FETCH_COLUMN);
                            echo $value;
                        ?></option>
                    </select>
                </div>
                <button type="submit" class="btn modal_btn modal_btn_mt15">записаться</button>
            </form>
        </div>


        <div class="modal" id="participants">
            <div class="modal_close">&times;</div>
            <div>
                <div class="modal_title modal_list_title">Мужской парный разряд</div>
                <ul class="modal_list" id="list_id">
                </ul>
            </div>
        </div>


        <div class="modal" id="workout">
            <div class="modal_close">&times;</div>
            <div class="modal_title">ЗАПИСАТЬСЯ НА ТРЕНИРОВКУ</div>
            <div class="modal_name">ТРЕНЕР</div>
            <div class="modal_org">ОСИПОВ СЕРГЕЙ ВЛАДИСЛАВОВИЧ<br>+7(950)004-84-74</div> 
            <div class="modal_subtitle">ДЛЯ ЗАПИСИ СВЯЖИТЕСЬ С НАМИ<br>ЛЮБЫМ УДОБНЫМ СПОСОБОМ</div>  
            <div class="modal_footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="tel:+79500048474"><button class="btn modal_btn">позвонить</button></a>
                    </div>
                    <div class="col-md-6 modal_social">
                        <a href=""><img src="icons/tennis/teleg.svg" alt=""></a>
                        <a href=""><img src="icons/tennis/VK.svg" alt=""></a>
                        <a href=""><img src="icons/tennis/ok.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal modal_mini" id="thanks">
            <div class="modal_close">&times;</div>
            <div class="modal_title">Спасибо за вашу заявку!</div>
            <div class="modal_subtitle">Организатор свяжется с вами в<br>ближайшее время!</div>
        </div>


        <div class="modal modal_tour" id="modal_tour">
            <div class="modal_close">&times;</div>
            <div class="container">
                <div class="modal_tour_body">
                    <div class="row" id="tour_year">
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <a href="#promo" class="pageup">
        <img src="icons/tennis/up_tennis.svg" alt="up" >
    </a>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>