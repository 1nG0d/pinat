
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Internet-shop</title>
	<meta name="keywords" content="peanut butter, peanut pasta, peanut butter Kyiv, Kyiv peanut butter " />
  	<meta name="description" content="Peanut butter shop in Kyiv. We have a wide range of this wonderful product." />
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
							<a href="../en.html#about">About company</a>
							<a href="../en.html#product">Product</a>
							<a href="../en.html#cooperation">Cooperation</a>	
						</div>
				
					
						<div class="logo_bg">
						 
							 <a href="../en.html#up">
							 	<img src="../img/logo_menu.png" alt="ТМ Пінат">
							 </a>
							 <i class="fa fa-times" aria-hidden="true" onclick="HideMenu();"></i>
						</div>

					
						<div class="right_menu right">
							<a href="../en.html#privateLable">Private Label</a>
							<a href="../en.html#vacancy">Job</a>
							<a href="../en.html#contacts">Contacts</a>				
						</div>	
						<div class="internet_shop">
								<div class="shopping_cart">
									<a href="carten.php?action=showcart" class="cart"><img src="../img/shopping_cart.png" alt="Інтернет-магазин"></a>
								</div>
								(<span id="cartCntItems">0</span>)
								<a href="carten.php?action=showcart" class="link">Cart</a>
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
					<a href="carten.php" class="internetShop"><img src="../img/shopping_cart.png" alt="Інтернет-магазин"></a>
					(<span id="cartCntItems">0</span>)	<a href="carten.php?action=showcart" class="link">Cart</a>
							
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
							<a href="#" class="addItemToCart" product_id="<?php echo $goods_id ?>" title="Add to cart"><img src="../images/<?php echo $myrow['img'] ?>.png" alt="Класік" class="<?php echo $myrow['img_size'] ?>" ></a>
							<div class="arrow_wrapper">
								<h2><?php echo $myrow['goods_name_en'] ?> <?php echo $myrow['quontity'] ?>gr.</h2>
								
							 <i id="down<?php echo $goods_id ?>"  class="fa fa-angle-down" onclick="slideDownDiv('#descr<?php echo $goods_id ?>'); hideArrow('up<?php echo $goods_id ?>','down<?php echo $goods_id ?>');"></i> 
                             <i id="up<?php echo $goods_id ?>" class="fa fa-angle-up" onclick="slideUpDiv('#descr<?php echo $goods_id ?>');  hideArrow('up<?php echo $goods_id ?>','down<?php echo $goods_id ?>');"></i> 
							</div>
						<div class="description" id="descr<?php echo $goods_id ?>">
							<table>
								<tr>
									<td>Description:</td>
									<td>
										<?php echo $myrow['descr_en'] ?>
									</td>
								</tr>
								<tr>
									<td>Consist:</td>
									<td>
										<?php echo $myrow['consist_en'] ?>
									</td>
								</tr>
								<tr>
									<td>The energy value in 100g :</td>
									<td><?php echo $myrow['energy_value_en'] ?></td>
								</tr>
								<tr>
									<td>Packaging:</td>
									<td><?php echo $myrow['packaging_en'] ?></td>
								</tr>
								<tr>
									<td>Net weight:</td>
									<td><?php echo $myrow['quontity'] ?>gr.</td>
								</tr>
								<tr>
									<td>Term of storage:</td>
									<td><?php echo $myrow['using_term'] ?> month</td>
								</tr>
							</table>			
									
						</div>
									<span>Price: <?php echo $myrow['price'] ?> UAH</span>
									<a href="carten.php?action=showcart" class="addItemToCart addButton" product_id="<?php echo $goods_id ?>">Buy</a>
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
					<h4>Delivery in Ukraine <br>
					"Nova Poshta"</h4>
					<p>Urgent or express delivery
the warehouse or at the following address </p>
				</div>
				<div class="footer_section">
					<img src="../img/list.png" alt="Замовлення у вихідні дні">
					<p>Ordering a weekend or holiday
days , sent on the first working day.</p>
				</div>
				<div class="footer_section">
					<img src="../img/port.png" alt="Бізнес-партнерство">
					<p>Maybe you are interested in
Business Partnership</p>
					<a href="../en.html#cooperation">>>Press here<<</a>
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
				<div class="col-md-12">
					<div class="pb">
						
								<h1>Nut butter: What? Where? When?</h1>					
<p>Today, there are many kinds of nut butter: peanut butter, almond butter, cashew butter, hazelnut butter and others. It is also especially popular Sesame Tahini butter or even some people say Thina.  We are going to tell you a little more about each of them.</p>
<p class="more" onclick="hideShowDiv('.details');">Read more &rarr;</p>
	<div class="details">
		<p>Watch an exclusive interview with the founder of the company "Pinat" Senikom Andrew </p>
		<p>
			<iframe  src="https://www.youtube.com/embed/Goyyx0px4qY" frameborder="0" allowfullscreen></iframe>
		</p>
<h2>Peanut butter</h2>
<p>Peanut butter is the most popular in the world. It is made from roasted peanut kernels. Most of all, this butter is consumed in the United States and Europe, mainly as spreads on bread. The most popular sandwich in America is called peanut butter & jelly (peanut butter and jam). It is sold in pure or with the addition of different ingredients: honey, salt, sugar, pieces of dried apricots, chocolate, etc. You could buy peanut butter with small peanut pieces inside this kind is called Crunchy. In our store PINAT you can buy peanut butter wholesale and retail. There is a special kind of peanut butter, which also produces our company PINAT, called Vegan. This type is specially produced for raw foodists. It is made from raw peanuts (only ingredient). This peanut butter you can also buy in our stationary shop in Kyiv. Another type of peanut butter, which offers our company is called Dessert. This is a sweet butter with a double portion of honey and vanilla. Especially children love it very much. By the way, the peanut butter you can buy in many vegetarian stores, because it is a natural product with plant components, it contains no animal fats. Buy peanut butter Kiev street. Reitarska 21/13, office 2. There is our retail store at this address. Our production is located in Vinnitsa city. We always offere available fresh peanut butter wholesale and retail.</p>
<h2>Almond butter</h2>
<p>This is a unique type of butter, which we produce. Athletes especially like it. All almond lovers will appreciate this truly tasty product. With us you can always buy almond butter, fresh and tasty. Almond butter is also popular in America. The best breakfast: fried crispy toast with almond butter. This kind of butter is widely used in cooking. I am sure that many of you tried croissants with almond filling and cake with almond butter. Therefore, we work with a café and confectionery, which are always the almond butter to buy in bulk to prepare their delicacies. Maybe the croissant that you ate today was with our almond butter.  Butter of almond wholesale and retail, are always fresh and tasty in our online store.</p>
<h2>Hazelnut butter</h2>
<p>Probably everyone tried hazelnut. In Ukraine, most of all hazelnut grows in the western part of the country and it is called Hazel. Mostly hazelnut imported to Ukraine from Turkey or Georgia, or America. It is the most high-calorie and oily nuts, so butter of hazelnut not as dense as other types of nut butter. But, at the same time, it is very tasty. It can be added to baked goods or other sweet dishes, porridges. Those who do not like peanuts, Hazelnut butter is perfect for breakfast. You can find many interesting recipes with this butter on our social pages. Of course, you can always buy fresh Hazelnut butter in our store.</p>
<h2>Cashew butter (Cashew butter)</h2>
<p>A unique product that we created is cashew butter. In this kind of butter, we do not even add the honey and salt. By itself, the cashew is very sweet. Did you know that the cashew is called "apple nut"? In fact, cashews is a great fruit similar to an apple that grows in tropical countries of Africa or America. And the nut, which we used to eat, is only a small component of this "apple", which grows below the fruit itself. Those who tried to "apple" cashew, say it is the most delicious fruit on earth. Unfortunately, it is not imported, because it is very perishable (1-2 days). Cashew butter, which we do, we can also say that it is the most delicious butter. Cashew butter can be bought in shops or retail stores. We sell cashew butter wholesale and retail. Try the cashew butter and get a lot of fun.</p>
<h2>Sesame butter, Tahini, Thina</h2>
<p>A special kind of butter, very helpful and genuine is the sesame butter. This product is popular with the residents of the East: Jews, Syrians, Turks, etc. The most common dish of sesame butter is hummus. Hummus is a dish made from chickpea (Indian pea) tucked Tahini (sesame butter with olive oil and garlic). Our sesame butter made only from the finest sesame seeds, certified suppliers. You could get Tahini always in our store or our partners’ stores. Cafes and restaurants can also take the sesame butter wholesale. We control that the product was the highest quality, not inferior to the Israeli, Turkish or Greek counterparts. Sesame butter contains a lot of calcium. Breastfeeding mums or people with lack of calcium are useful to eat this product. It is good to add to the porridges, do toppings on salads or gravy to meat dishes. Of course, you can eat sesame as seeds.
At the requests of peanut butter Kiev or buy peanut butter Kiev you will always find our shop. But, you can buy peanut butter not only in Kiev. Our partners sell peanut butter PINAT throughout Ukraine: Dnepropetrovsk, Kharkov, Zaporizhzhya, Chernigov, Lvov, Odessa, Vinnitsa, etc. And of course we always glad good cooperation and have a commercial offer for cafe, restaurants, pastry shops. We have a wholesale peanut butter or other nut butter wholesale. We are very hospitable and will be pleased to any client. You could Buy peanut butter tm Pinat in retail chains.
Buy peanut butter Kiev Reitarska str. 21/13, office 2. Always available tasty nut butter. Buy it  easy and simple.

</p>
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