<header>
	<nav>
		<a href="#promo"><div class="logo"><?php echo $config['title']; ?></div></a>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<ul class="menu">
						<li><a href="#categories" class="menu_link">категории</a></li>
						<li><a href="#courts" class="menu_link">корты</a></li>
						<li><a href="#history" class="menu_link">история</a></li>
						<li><a href="#sing" class="menu_link">тренировки</a></li>
						<li><a href="#footer" class="menu_link">контакты</a></li>
					</ul>
					<ul class="menu_sm">
						
						<li><a href="#categories_sm" class="menu_sm_link">категории</a></li>
						<li><a href="#courts" class="menu_sm_link">корты</a></li>
						<li><a href="#history_sm" class="menu_sm_link">история</a></li>
						<li><a href="#sing" class="menu_sm_link">тренировки</a></li>
						<li><a href="#footer" class="menu_sm_link">контакты</a></li>
					</ul>
				</div>
				<div class="col-lg-2 offset-lg-2 col-md-3 offset-md-1 col-sm-4 offset-sm-8 col-5 offset-7">
					<a href="tel:+79500048474"><div class="phone">
					<?php
						$sth = $db->prepare("SELECT `phone` FROM `organizer` WHERE id=1");
						$sth->execute(array());
						$value = $sth->fetch(PDO::FETCH_COLUMN);
						echo $value;
					?>
					</div></a>
				</div>
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
	</nav>
</header>