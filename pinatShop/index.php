
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Интернет-магазин</title>
	<meta name="keywords" content="арахисовая паста, арахисовое масло, арахисовое масло киев, арахисовая паста киев." />
  	<meta name="description" content="Интернет магазин арахисовой пасты в городе Киев. У нас широкий ассортимент - этого замечательного продукта." />
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
							<a href="../index.html#about">О компании</a>
							<a href="../index.html#product">Продукция</a>
							<a href="../index.html#cooperation">Сотрудничество</a>	
			</div>
					<div class="logo_bg">
						 
							 <a href="../index.html#up">
							 	<img src="../img/logo_menu.png" alt="ТМ Пінат">
							 </a>
							 <i class="fa fa-times" aria-hidden="true" onclick="HideMenu();"></i>
						</div>
						
					<div class="right_menu right">
							<a href="../index.html#privateLable">Private Label</a>
							<a href="../index.html#vacancy">Вакансии</a>
							<a href="../index.html#contacts">Контакты</a>				
						</div>	
							
							<div class="internet_shop">
								<div class="shopping_cart">
									<a href="cartru.php?action=showcart" class="cart"><img src="../img/shopping_cart.png" alt="Інтернет-магазин"></a>
								</div>
								(<span id="cartCntItems">0</span>)
								<a href="cartru.php?action=showcart" class="link">Корзина</a>
							</div>				
						</div>	
					</div>
				</div>
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
					<a href="cartru.php" class="internetShop"><img src="../img/shopping_cart.png" alt="Інтернет-магазин"></a>
					(<span id="cartCntItems">0</span>)	<a href="cartru.php?action=showcart" class="link">Корзина</a>
							
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
				<div class="col-md-4 col-sm-12">
					<div class="shopItem">
						<?php $goods_id=$myrow['goods_id']?>
							<a href="#" class="addItemToCart" product_id="<?php echo $goods_id ?>" title="Добавить в корзину"><img src="../images/<?php echo $myrow['img'] ?>.png" alt="<?php echo $myrow['goods_name_ru'] ?>" class="<?php echo $myrow['img_size'] ?>" ></a>
							<div class="arrow_wrapper">
								<h2><?php echo $myrow['goods_name_ru'] ?> <?php echo $myrow['quontity'] ?>г.</h2>
								
							 <i id="down<?php echo $goods_id ?>"  class="fa fa-angle-down" onclick="slideDownDiv('#descr<?php echo $goods_id ?>'); hideArrow('up<?php echo $goods_id ?>','down<?php echo $goods_id ?>');"></i> 
                             <i id="up<?php echo $goods_id ?>" class="fa fa-angle-up" onclick="slideUpDiv('#descr<?php echo $goods_id ?>');  hideArrow('up<?php echo $goods_id ?>','down<?php echo $goods_id ?>');"></i> 
							</div>
						<div class="description" id="descr<?php echo $goods_id ?>">
							<table>
								<tr>
									<td>Описание:</td>
									<td>
										<?php echo $myrow['descr_ru'] ?>
									</td>
								</tr>
								<tr>
									<td>Состав:</td>
									<td>
										<?php echo $myrow['consist_ru'] ?>
									</td>
								</tr>
								<tr>
									<td>Энергетическая ценность в 100г.:</td>
									<td><?php echo $myrow['energy_value_ru'] ?></td>
								</tr>
								<tr>
									<td>Упаковка:</td>
									<td><?php echo $myrow['packaging_ru'] ?></td>
								</tr>
								<tr>
									<td>Масса нетто:</td>
									<td><?php echo $myrow['quontity'] ?>г.</td>
								</tr>
								<tr>
									<td>Срок хранения:</td>
									<td><?php echo $myrow['using_term'] ?> мeс.</td>
								</tr>
							</table>			
									
						</div>
									<span>Цена: <?php echo $myrow['price'] ?> грн.</span>
									<a href="cartru.php?action=showcart" class="addItemToCart addButton" product_id="<?php echo $goods_id ?>">Купить</a>
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
					<h4>Доставка по Украине <br>
					"Новая Почта"</h4>
					<p>Срочная или экспресс-доставка
					на склад или по адресу.</p>
				</div>
				<div class="footer_section">
					<img src="../img/list.png" alt="Замовлення у вихідні дні">
					<p>Заказ оформленый в выходные или праздничные
дни, отправляется в первый рабочий день.</p>
				</div>
				
				
			
				
				<div class="footer_section">
					<img src="../img/port.png" alt="Бізнес-партнерство">
					<p>Может вас интересует 
						бизнес-партнерство</p>
					<a href="../ru.html#cooperation"><<Нажимайте сюда>></a>
				</div>
					<div class="footer_section">
					<img src="../img/phone.png" alt="Как с нами связаться?">
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
						<a href="https://www.facebook.com/pastapinat/ "><img src="../img/facebook.png" alt="Мы в Facebook"></a>
						<a href="https://vk.com/pastapinat"><img src="../img/vk.png" alt="Мы вКонтакте"></a>
						<a href="https://www.youtube.com/channel/UCzsqI3FwNWVfaZOTSKIYpfw?guided_help_flow=3"><img src="../img/youTube.png" alt="Мы на YouTube"></a>
				</div>
			</div>
		
				</div>
				
				<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="pb">
						<h1>Арахисовая паста или арахисовое масло. Ореховые пасты: Что? Где? Когда?</h1>
<p>На сегодняшний день существую много видов ореховых паст: арахисовая паста или по-другому называют арахисовое масло, миндальная паста, кешью паста, фундуковая паста и другие. Также особой популярностью пользуется кунжутная паста или Тхина, еще говорят Тахини.  Расскажем немного подробнее о каждой из них.</p>
<p class="more" onclick="hideShowDiv('.details');">Читать польностью &rarr;</p>
	<div class="details">
		<p>Смотри эксклюзивное интервью с основателем компании "Pinat" Сеныком Андреем</p>
		<p>
			<iframe  src="https://www.youtube.com/embed/Goyyx0px4qY" frameborder="0" allowfullscreen></iframe>
		</p>

<br>
<h2>Арахисовая паста</h2>
<p>Паста арахисовая или масло арахисовое (от анг. Peanut butter) самая популярная паста ореховая в мире. Она сделанная из жаренных ядер арахиса. Более всего эту пасту употребляют в США и Европе в основном как намазку на хлеб. Самый популярный бутерброд в Америке называется peanut butter & jelly (арахисовая паста с вареньем). Она продается в чистом виде или с добавлением разных ингредиентов: меда, соли, сахара, кусочки кураги, шоколада и т.д. Купить арахисовую пасту можно с кусочками арахиса внутри, этот вид называется Кранч (англ. Crunchy). В нашем магазине PINAT можно арахисовую пасту купить оптом и в розницу. Есть особый вид арахисовой пасты, которую также производит наша компания PINAT, и называется Веган (Vegan). Этот вид специально предназначен для сыроедов. Она сделанная из сырого арахиса (единственный ингредиент). Эту арахисовую пасту купить можно также и в нашем стационарном магазине в Киеве.  Еще один вид орехового масла, который предлагает наша компания, называется Дессерт (Dessert). Это сладкая паста с двойной порцией меда и ванилином. Особенно нравится детям. Кстати, арахисовое масло купить можно во многих вегетарианских магазинах, ведь это натуральный продукт с растительными составляющими, он не содержит животных жиров. Купить арахисовое масло Киев ул. Рейтарская, 21/13, оф.2. По этому адресу наш розничный магазин. Наше производство находится в Виннице. У нас всегда  в наличии свежее арахисовое масло оптом и в розницу.</p>
<h2>Миндальная паста (almond butter)</h2>
<p>Это уникальный вид пасты, который мы изготавливаем. Она особенно нравится спортсменам. Все любители миндаля оценят этот действительно вкусный продукт. У нас Вы всегда сможете купить миндальную пасту, свежую и вкусную. Миндальная паста также популярна в Америке. Самый лучше завтрак: поджаренный хрустящий тост с миндальной пастой. Этот вид пасты широко используется в кулинарии. Уверен, что многие из вас пробовали круассан с миндальной начинкой или кекс с пастой из миндаля. Поэтому мы работает с кафе и кондитерскими, которые всегда могут миндальную пасту купить оптом для приготовления своих вкусностей. Может именно тот круассан, который Вы съели сегодня с нашей пастой  Миндальная паста оптом и в розницу, всегда свежая и вкусная в нашем Интернет-магазине.</p>
<h2>Фундуковая паста (hazelnut butter)</h2>
<p>Наверное, каждый пробовал фундук или лесной орех. В Украине лесной орех больше всего растет в западной части страны – его называют Лещина. Фундук (брат Лещины))) привозят из Турции или Грузии, или Америки. Это самый калорийный и маслянистый орех, поэтому паста фундуковая не такая густая, как другие виды ореховых паст. Но, при этом, она очень вкусная. Ее можно добавлять в выпечку или другие сладкие блюда, каши. Те, кто не любит арахис, фундуковая паста прекрасно подойдет на завтрак. Вы можете найти много интересных рецептов с этой пастой на наших социальных страницах. Конечно, Вы всегда можете свежую фундуковую пасту купить в нашем магазине.</p>
<h2>Кешью паста (cashew butter)</h2>
<p> Уникальный продукт, который мы создали – паста кешью. В этот вид пасты мы не добавляем даже меда и соли. Сам по себе орех кешью очень сладкий. А знаете ли Вы, что кешью еще называют «яблочный орех»? На самом деле кешью – это большой плод, схожий с яблоком, которое растет в жарких странах Африки или Америки. А тот орешек, который мы привыкли есть, только небольшая составляющая этого «яблока», которая растет ниже самого плода. Те, кто пробовал «яблоко» кешью, говорят, что это самый вкусный плод на земле. К сожалению, он не импортируется, потому что очень быстро портится (1-2 дня). Паста кешью, которую мы делаем, можно тоже сказать, что это самая вкусная паста из всех паст. Кешью пасту купить можно в торговой сети или розненных магазина. У нас продается кешью паста оптом и в розницу. Попробуйте пасту кешью и получите море удовольствия.</p>
<h2>Кунжутная паста, Тхина, Тахини (Sesame bytter, Thina, Tahini)</h2>
<p>Особый вид пасты, очень полезная и натуральная, - кунжутная паста. Этот продукт популярен у жителей Востока: евреев, сирийцев, турков и т.д. Самое распространенное блюдо из кунжутной пасты – хумус. Хумус – блюдо приготовленное из нута (индийского гороха) заправленное тхиной (кунжутной пастой с оливковым маслом и чесноком). Наша кунжутная паста только из лучших семян кунжута, проверенных поставщиков-друзей. Купить тахини всегда можно в нашем магазине или у наш партнеров. Кафе и рестораны также могут взять кунжутную пасту оптом. Мы контролируем, что этот продукт был самого высокого  качества, не уступал израильским, турецким или грецким аналогам. Еще кунжутная паста ценная наличием кальция. Кормящим мамочкам или людям с недостатком кальция полезно употреблять этот продукт: добавлять в кашу, делать топпинги на салаты или подливу для мясных блюд. Конечно, кунжут можно и так кушать, как семечки.</p>
<p>По заказу мы можем делать пасту из грецкого ореха. По своим полезным свойствам паста из грецкого ореха не уступает другим ореховым пастам.</p>
<p>По запросам арахисовое масло киев или арахисовая паста киев Вы всегда найдете наш И-магазин. Но, купить арахисовое масло можно не только в Киеве. Наши партнеры продают ореховое масло тм PINAT по всей Украине: Днепропетровск, Харьков, Запорожье, Чернигов, Львов, Одесса, Винница и т.д.  И конечно мы предлагаем сотрудничество кафе, ресторанам, кондитерским. У нас есть арахисовая паста оптом или другая ореховая паста оптом. Мы очень гостеприимные  и будем рады любому клиенту. Купить ореховое масло Пинат можно и в торговых сетях.  </p>
<p>Города доставки: Киев, Днепропетровск (Днепр), Харьков, Львов, Одесса, Винница, Кривой Рог, Чернигов, Херсон, Николаев, Донецк, Полтава, Запорожье, Кировоград, Житомир, Черкассы, Ровно, Мариуполь, Днепродзержинск, Ивано-Франковск, Калуш Буча, Ирпень, Белая Церковь, Бровары, Вишневое и другие города Украины.</p>

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