<footer class="footer" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 footer_phone"><a href="tel:+79500048474">
            <?php
                $sth = $db->prepare("SELECT `phone` FROM `organizer` WHERE id=1");
                $sth->execute(array());
                $value = $sth->fetch(PDO::FETCH_COLUMN);
                echo $value;
            ?>
            </a></div>
            <div class="col-xl-2 offset-xl-2 col-md-2 offset-md-1 col-sm-6  footer_logo"><a href="#promo"><?php echo $config['title']; ?></a></div>
            <div class="col-xl-3 offset-xl-1 col-lg-3 offset-lg-2 col-md-4 offset-md-1 col-sm-10 offset-sm-1">
                <div class="footer_icons">
                    <a href="https://www.instagram.com/ontennis.ru/"><img src="icons/inst.png" alt=""></a>
                    <a href="https://t.me/ontennisru"><img src="icons/telegram.png" alt=""></a>
                    <a href=""><img src="icons/Whatsapp.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</footer>