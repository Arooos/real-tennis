<?php
    require "../../app/connection/tennis_cnf.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-grid.min.css">
    <title>Admin</title>
</head>
<body>
    <!-- Промо -->
    <div class="container" style="margin: 0 auto;margin-top:100px; max-width: 600px;">
        <?php if(!empty($_SESSION['login'])) :?>
        <form class="feed-form" action="addtour.php" method="post">
        <div style="display:block;margin: 0 auto;">Промо</div>
        <!-- Название турнира -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Название турнира (шапка)</span>
            <input class="form-control" name="name_of_tour"  type="name_of_tour" method="post" required>
        </div>
        <!-- выбор категории -->
        <div style="margin: 0 auto;max-width: 600px;" class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Категория</label>    
            <select  name="categories" id="" class="form-select" method="post">
                <?php
                $sth = $db->prepare("SELECT * FROM `categories`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $opt = $db->prepare("SELECT `name` FROM `categories` WHERE id=$cat_v[id]");
                        $opt->execute(array());
                        $value = $opt->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- выбор места проведения -->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Место</label>
            <select name="place" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `place`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $opt = $db->prepare("SELECT `name` FROM `place` WHERE id=$cat_v[id]");
                        $opt->execute(array());
                        $value = $opt->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- выбор адреса площадки -->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Адрес</label>
            <select name="address" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `address`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $opt = $db->prepare("SELECT `name` FROM `address` WHERE id=$cat_v[id]");
                        $opt->execute(array());
                        $value = $opt->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- дата проведения -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Дата</span>
            <input class="form-control" name="data" type="date" method="post" required>
        </div>
        <!-- время начала -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Время начала</span>
            <input class="form-control" name="time" type="time" method="post" required>
        </div>
        <!-- взнос за участие -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Взнос</span>
            <input class="form-control" name="price"  type="price" method="post" required>
        </div>
        <!-- выбор уровня игрока -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Уровень допуска игрока</span>
            <select name="class" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `class`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $class = $db->prepare("SELECT `name` FROM `class` WHERE id=$cat_v[id]");
                        $class->execute(array());
                        $value = $class->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- выбор организатора -->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Организатор</label>
            <select name="organizer" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `organizer`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $organizer = $db->prepare("SELECT `name` FROM `organizer` WHERE id=$cat_v[id]");
                        $organizer->execute(array());
                        $value = $organizer->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                    }
                ?>
            </select>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Год</label>
            <select name="year" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `years`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $organizer = $db->prepare("SELECT `year` FROM `years` WHERE id=$cat_v[id]");
                        $organizer->execute(array());
                        $value = $organizer->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                    }
                ?>
            </select>
        </div>
        <!-- кнопки "выйти" и "добавить" -->
        <div class="row">
            <div class="col-6">
                <a class="btn btn-primary" style="width: 100px" href="logout.php">Выйти</a>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary" style="display: block;margin-right: 0;margin-left: auto;width: 100px">Добавить</button>
            </div>
        </div>
        <!-- если сессия не открыта -->
        <?php else:
            echo '<h2>Вы что хакер?</h2>';
            echo '<a href="/">На главную</a>';
        ?>
        <?php endif ?> 
        </form>
    </div>

    <!-- Анонс турнира -->
    <div class="container" style="margin: 0 auto;margin-top:100px; max-width: 600px;">
        <?php if(!empty($_SESSION['login'])) :?>
        <form class="feed-form" action="addtour.php" method="post">
        <div style="display:block;margin: 0 auto;">Промо</div>
        <!-- Название турнира -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Название турнира (шапка)</span>
            <input class="form-control" name="name_of_tour"  type="name_of_tour" method="post" required>
        </div>
        <!-- выбор категории -->
        <div style="margin: 0 auto;max-width: 600px;" class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Категория</label>    
            <select  name="categories" id="" class="form-select" method="post">
                <?php
                $sth = $db->prepare("SELECT * FROM `categories`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $opt = $db->prepare("SELECT `name` FROM `categories` WHERE id=$cat_v[id]");
                        $opt->execute(array());
                        $value = $opt->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- выбор места проведения -->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Место</label>
            <select name="place" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `place`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $opt = $db->prepare("SELECT `name` FROM `place` WHERE id=$cat_v[id]");
                        $opt->execute(array());
                        $value = $opt->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- выбор адреса площадки -->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Адрес</label>
            <select name="address" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `address`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $opt = $db->prepare("SELECT `name` FROM `address` WHERE id=$cat_v[id]");
                        $opt->execute(array());
                        $value = $opt->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- дата проведения -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Дата</span>
            <input class="form-control" name="data" type="date" method="post" required>
        </div>
        <!-- время начала -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Время начала</span>
            <input class="form-control" name="time" type="time" method="post" required>
        </div>
        <!-- взнос за участие -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Взнос</span>
            <input class="form-control" name="price"  type="price" method="post" required>
        </div>
        <!-- выбор уровня игрока -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Уровень допуска игрока</span>
            <select name="class" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `class`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $class = $db->prepare("SELECT `name` FROM `class` WHERE id=$cat_v[id]");
                        $class->execute(array());
                        $value = $class->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
        <!-- выбор организатора -->
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Организатор</label>
            <select name="organizer" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `organizer`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $organizer = $db->prepare("SELECT `name` FROM `organizer` WHERE id=$cat_v[id]");
                        $organizer->execute(array());
                        $value = $organizer->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                    }
                ?>
            </select>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Год</label>
            <select name="year" class="form-select" method="post">
                <?php 
                $sth = $db->prepare("SELECT * FROM `years`");
                $sth->execute(array());
                $cat_va = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat_va as $cat_v){?>
                <option>
                    <?php
                        $organizer = $db->prepare("SELECT `year` FROM `years` WHERE id=$cat_v[id]");
                        $organizer->execute(array());
                        $value = $organizer->fetch(PDO::FETCH_COLUMN);
                        echo $value;
                    ?>
                </option>
                <?php
                    }
                ?>
            </select>
        </div>
        <!-- кнопки "выйти" и "добавить" -->
        <div class="row">
            <div class="col-6">
                <a class="btn btn-primary" style="width: 100px" href="logout.php">Выйти</a>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary" style="display: block;margin-right: 0;margin-left: auto;width: 100px">Добавить</button>
            </div>
        </div>
        <!-- если сессия не открыта -->
        <?php else:
            echo '<h2>Вы что хакер?</h2>';
            echo '<a href="/">На главную</a>';
        ?>
        <?php endif ?> 
        </form>
    </div>
</body>
</html>