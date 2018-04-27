
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Інтернет-магазин</title>
	<meta name="keywords" content="арахісова паста, арахісове масло, арахісове масло київ, арахісова паста київ." />
  	<meta name="description" content="Інтернет магазин арахісової пасти в місті Київ. У нас широкий асортимент - цього чудового продукту." />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<link rel="stylesheet" href="../libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
	<link rel="stylesheet" href="../libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="../libs/owl-carousel/owl.carousel.css" />	
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="../libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="../css/fonts.css" />
	<link rel="stylesheet" href="../css/pinatShop.css" />
	<link rel="stylesheet" href="../css/media.css" />
</head>
<body>
	<nav class="top_menu clearfix">
					
						<div class="left_menu left">
							<a href="../ua.html#about">Про компанію</a>
							<a href="../ua.html#product">Продукція</a>
							<a href="../ua.html#cooperation">Співробітництво</a>	
						</div>
				
					
						<div class="logo_bg">
						 
							 <a href="../ua.html#up">
							 	<img src="../img/logo_menu.png" alt="ТМ Пінат">
							 </a>
							 <i class="fa fa-times" aria-hidden="true" onclick="HideMenu();"></i>
						</div>

					
						<div class="right_menu right">
							<a href="../ua.html#privateLable">Private Label</a>
							<a href="../ua.html#vacancy">Вакансії</a>
							<a href="../ua.html#contacts">Контакти</a>				
						</div>	
						<div class="internet_shop">
								<div class="shopping_cart">
									<a href="cart.php?action=showcart" class="cart"><img src="../img/shopping_cart.png" alt="Інтернет-магазин"></a>
								</div>
								(<span id="cartCntItems">0</span>)
								<a href="cart.php?action=showcart" class="link">Кошик</a>
							</div>
		</nav>
	<nav class="min_menu">
				<div class="left_menu left">
					<h3>pinat.com.ua</h3>
				</div>	
 				<div class="logo_bg">
 					<i class="fa fa-bars" aria-hidden="true" onclick="ShowMinMenu();"></i>
 				</div>
				<div class="right_menu right">
					<a href="cart.php" class="internetShop"><img src="../img/shopping_cart.png" alt="Інтернет-магазин"></a>
					(<span id="cartCntItems">0</span>)	<a href="cart.php?action=showcart" class="link">Кошик</a>
							
				</div>		
 		</nav>
	<main>
		<div class="container">
		<div class="row">
		<?php
			 include("../blocks/db.php");
			
			$result=mysqli_query($db,"SELECT * FROM goods WHERE visibility='true' ORDER BY position");
			$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$i=0;
				do {
				?>
				<div class="col-md-4">
					<div class="shopItem">
						<?php $goods_id=$myrow['goods_id']?>
							<a href="#" class="addItemToCart" product_id="<?php echo $goods_id ?>" title="Додати у кошик"><img src="../images/<?php echo $myrow['img'] ?>.png" alt="Класік" class="<?php echo $myrow['img_size'] ?>" ></a>
							<div class="arrow_wrapper">
								<h2><?php echo $myrow['goods_name'] ?> <?php echo $myrow['quontity'] ?>г.</h2>
								
							 <i id="down<?php echo $goods_id ?>"  class="fa fa-angle-down" onclick="slideDownDiv('#descr<?php echo $goods_id ?>'); hideArrow('up<?php echo $goods_id ?>','down<?php echo $goods_id ?>');"></i> 
                             <i id="up<?php echo $goods_id ?>" class="fa fa-angle-up" onclick="slideUpDiv('#descr<?php echo $goods_id ?>');  hideArrow('up<?php echo $goods_id ?>','down<?php echo $goods_id ?>');"></i> 
							</div>
						<div class="description" id="descr<?php echo $goods_id ?>">
							<table>
								<tr>
									<td>Опис:</td>
									<td>
										<?php echo $myrow['descr'] ?>
									</td>
								</tr>
								<tr>
									<td>Склад:</td>
									<td>
										<?php echo $myrow['consist'] ?>
									</td>
								</tr>
								<tr>
									<td>Енергетична цінність в 100г.:</td>
									<td><?php echo $myrow['energy_value'] ?></td>
								</tr>
								<tr>
									<td>Упаковка:</td>
									<td><?php echo $myrow['packaging'] ?></td>
								</tr>
								<tr>
									<td>Масса нетто:</td>
									<td><?php echo $myrow['quontity'] ?>г.</td>
								</tr>
								<tr>
									<td>Термін зберігання:</td>
									<td><?php echo $myrow['using_term'] ?> міс.</td>
								</tr>
							</table>			
									
						</div>
									<span>Ціна: <?php echo $myrow['price'] ?> грн.</span>
										<a href="cart.php?action=showcart" class="addItemToCart addButton" product_id="<?php echo $goods_id ?>">Придбати</a>
									
						</div>
				</div>
			<?php 
				
				if($i==2)
					{
						echo "</div><div class='row'>";
						$i=0;
					}
					
				else {$i++;}	
				
				}
			while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC));
				?>	
			
			
			
		</div>
	</main>
	
	<!------------------------------Footer------------------------------->
	<footer>
		<div class="container">
			<div class="row">
				<div class="footer_section">
					<img src="../img/Np.png" alt="Доставка по Україні">
					<h4>Доставка по Україні "Нова Пошта"</h4>
					<p>Термінова чи експрес-доставка
					 до складу чи за адресою.</p>
				</div>
				<div class="footer_section">
					<img src="../img/list.png" alt="Замовлення у вихідні дні">
					<p>Замовлення оформлені у вихідні чи святкові 
					дні, відправляються в перший робочий день.</p>
				</div>
				<div class="footer_section">
					<img src="../img/port.png" alt="Бізнес-партнерство">
					<p>Можливо вас цікавить бізнес-партнерство</p>
					<a href="../ua.html#cooperation"><<Натискайте сюди>></a>
				</div>
				<div class="footer_section">
					<img src="../img/phone.png" alt="Як з нами зв'язатися?">
					<telephone>
						+38 096 887 01 37
					</telephone>
					<telephone>
						+38 066 333 35 81
					</telephone>
					<telephone>
						+38 093 880 78 20
					</telephone>
				</div>
				<div class="footer_section">
				<p class="soc">Follow us in social</p>
					<div class="social">
						<a href="https://www.facebook.com/pastapinat/ "><img src="../img/facebook.png" alt="Ми в Facebook"></a>
						<a href="https://vk.com/pastapinat"><img src="../img/vk.png" alt="Ми вКонтакті"></a>
						<a href="https://www.youtube.com/channel/UCzsqI3FwNWVfaZOTSKIYpfw?guided_help_flow=3"><img src="../img/youTube.png" alt="Ми на YouTube"></a>
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="pb">
						<h1>Горіхові пасти: Що? Де? Коли?</h1>
												
<p>На сьогоднішній день існують багато видів горіхових паст: арахісова паста або по-іншому називають арахісове масло, мигдалева паста, кеш’ю паста, фундукова паста та інші. Також особливою популярністю користується кунжутова паста або Тхіна, ще кажуть Тахіна. Розповімо трохи докладніше про кожну з них.</p>
	<p class="more" onclick="hideShowDiv('.details');">Читати повністю &rarr;</p>
	<div class="details">
		<p>Дивись ексклюзивне інтерв'ю з засновником компанії "Пінат" Сеником Андрієм</p>
	<p>
		<iframe  src="https://www.youtube.com/embed/Goyyx0px4qY" frameborder="0" allowfullscreen></iframe>
	</p>
<h2>Арахісова паста</h2>
<p>Паста арахісова або масло арахісове (від анг. Peanut butter) найпопулярніша паста горіхова в світі. Вона зроблена зі смажених ядер арахісу. Найбільше цю пасту вживають в США та Європі, в основному намащують на хліб. Найпопулярніший бутерброд в Америці називається peanut butter & jelly (арахісова паста з варенням). Вона продається в чистому вигляді або з додаванням різних інгредієнтів: меду, солі, цукру, шматочки кураги, шоколаду і т.д. Купити арахісову пасту можна зі шматочками арахісу всередині, цей вид називається Кранч (англ. Crunchy). У нашому магазині PINAT арахісову пасту можна купити оптом і в роздріб. Є особливий вид арахісової пасти, яку також виробляє наша компанія PINAT, і називається Веган (Vegan). Цей вид спеціально призначений для сироїдів. Вона зроблена з сирого арахісу (єдиний інгредієнт). Цю арахісову пасту купити можна також і в нашому стаціонарному магазині в Києві. Ще один вид горіхового масла, який пропонує наша компанія, називається Десерт (Dessert). Це солодка паста з подвійною порцією меду і ваніліном. Особливо подобається дітям. До речі, арахісове масло купити можна в багатьох вегетаріанських магазинах, адже це натуральний продукт з рослинними складовими, він не містить тваринних жирів. Купити арахісове масло Київ вул. Рейтарська, 21/13, оф.2. За цією адресою наш роздрібний магазин. Наше виробництво знаходиться в Вінниці. У нас завжди в наявності свіже арахісове масло оптом і в роздріб.</p>
<h2>Мигдалева паста (Almond butter)</h2>
<p>Це унікальний вид пасти, який ми виготовляємо. Вона особливо подобається спортсменам. Всі любителі мигдалю оцінять цей дійсно смачний продукт. У нас Ви завжди зможете купити мигдалеву пасту свіжу і смачну. Мигдалева паста також популярна в Америці. Самий кращий сніданок: підсмажений хрусткий тост з мигдалевою пастою. Цей вид пасти широко використовується в кулінарії. Упевнений, що багато хто з вас куштували круасан з мигдалевою начинкою або кекс із пастою з мигдалю. Тому ми співпрацюємо з кафе і кондитерськими, які завжди можуть мигдалеву пасту купити оптом для приготування своїх смаколиків. Може саме той круасан, який Ви з'їли сьогодні був з нашої пастою . Мигдальна паста оптом і в роздріб, завжди свіжа і смачна в нашому Інтернет-магазині.</p>
<h2>Фундукова паста (Нazelnut butter)</h2>
<p>Напевно, кожен пробував фундук або лісовий горіх. В Україні лісовий горіх найбільше росте в західній частині країни - його називають Ліщина. Фундук (брат Ліщини))) привозять із Туреччини чи Грузії, або Америки. Це самий калорійний і маслянистий горіх, тому паста фундукова не така густа, як інші види горіхових паст. Але, при цьому, вона дуже смачна. Її можна додавати в випічку або інші солодкі страви, каші. Ті, хто не любить арахіс, фундукова паста прекрасно підійде на сніданок. Ви можете знайти багато цікавих рецептів з цією пастою на наших соціальних сторінках. Звичайно, Ви завжди можете свіжу фундукову пасту купити в нашому І-магазині.</p>
<h2>Кеш’ю паста (Cashew butter)</h2>
<p> Унікальний продукт, який ми створили - паста кеш’ю. В цей вид пасти ми не додаємо навіть меду і солі. Сам по собі горіх кеш'ю дуже солодкий. А чи знаєте Ви, що кеш’ю ще називають «яблуневий горіх»? Насправді кеш’ю - це великий плід, схожий з яблуком, яке росте в жарких країнах Африки або Америки. А той горішок, який ми звикли їсти, тільки невелика складова цього «яблука», яка росте нижче самого плоду. Ті, хто пробував «яблуко» кеш’ю, кажуть, що це найсмачніший плід на землі. На жаль, він не імпортується, тому що дуже швидко псується (1-2 дні). Паста кеш'ю, яку ми робимо, можна теж сказати, що це найсмачніша паста з усіх паст. Кеш’ю пасту купити можна в торговельній мережі або роздрібних магазинах. У нас продається кеш’ю паста оптом і в роздріб. Спробуйте пасту кеш’ю і отримаєте море задоволення.</p>
<h2>Кунжутова паста, Тхіна, Тахіна (Sesame butter, Thina, Tahini)</h2>
<p>Особливий вид пасти, дуже корисна і натуральна - кунжутова паста. Цей продукт популярний у жителів Сходу: євреїв, сирійців, турків і т.д. Найпоширеніша страва з кунжутової пасти - хумус. Хумус - страва приготовлена з нуту (індійського гороху) заправленим тхіной (кунжутовою пастою з оливковою олією і часником). Наша кунжутова паста тільки з кращого насіння кунжуту, перевірених постачальників-друзів. Купити Тахіні завжди можна в нашому магазині або у наших партнерів. Кафе і ресторани також можуть взяти кунжутову пасту оптом. Ми контролюємо, щоб цей продукт був найвищої якості, щоб не поступався ізраїльським, турецьким чи грецьким аналогам. Ще кунжутова паста цінна наявністю кальцію. Матусям, що годують малюків, або людям з недоліком кальцію корисно вживати цей продукт: додавати в кашу, робити топпінги для салатів або підливу для м'ясних страв. Звичайно, кунжут можна і так їсти, як насіння.
За запитами арахісове масло київ або арахісова паста київ Ви завжди знайдете наш І-магазин. Але, купити арахісове масло можна не тільки в Києві. Наші партнери продають горіхове масло тм PINAT по всій Україні: Дніпропетровськ, Харків, Запоріжжя, Чернігів, Львів, Одеса, Вінниця тощо. І звичайно ми пропонуємо співпрацю для кафе, ресторанів, кондитерським. У нас є арахісова паста оптом або інша горіхова паста оптом. Ми дуже гостинні і будемо раді будь-якому клієнту. Купити горіхове масло Пінат можна і в торгових мережах.
Купити арахісову пасту Київ вул. Рейтарська, 21/13, оф.2. Завжди в наявності горіхова паста купити яку легко і просто.</p>
<p>Міста доставки:Київ, Дніпропетровськ (Дніпр), Харків, Львів,Одеса, Вінниця, Кривий Ріг, Чернігів, Херсон, Миколаїв, Донецьк, Полтава, Запоріжжя, Кіровоград, Житомир, Черкаси, Рівне, Маріуполь, Дніпродзержинськ,Івано-Франківськ, Ка́луш, Буча, Ірпінь, Біла Церква, Бровари, Вишневе та інші міста України.</p>
	</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--[if lt IE 9]>
	<script src="../libs/html5shiv/es5-shim.min.js"></script>
	<script src="../libs/html5shiv/html5shiv.min.js"></script>
	<script src="../libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="../libs/respond/respond.min.js"></script>
	<![endif]-->
	<script src="../libs/jquery/jquery.min.js"></script>
	<script src="../libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script src="../libs/fancybox/jquery.fancybox.pack.js"></script>
	<script src="../libs/waypoints/waypoints-1.6.2.min.js"></script>
	<script src="../libs/scrollto/jquery.scrollTo.min.js"></script>
	<script src="../libs/owl-carousel/owl.carousel.min.js"></script>
	<script src="../libs/PageScroll2id/PageScroll2id.min.js"></script>
	<script src="../js/jquery.magnific-popup.js"></script>	
	<script src="../libs/countdown/jquery.plugin.js"></script>
	<script src="../libs/countdown/jquery.countdown.min.js"></script>
	<script src="../libs/countdown/jquery.countdown-ru.js"></script>
	<script src="../libs/landing-nav/navigation.js"></script>
	<script src="../js/common.js"></script>
	<!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
	<!-- Google Analytics counter --><!-- /Google Analytics counter -->
</body>
</html>