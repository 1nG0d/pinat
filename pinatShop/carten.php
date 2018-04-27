<?php
    include("../blocks/db.php");
	include("../functions/functions.php");

session_start(); 

	$id=$_GET["id"];
    $action=$_GET["action"];

    switch ($action) {

       case 'clear':
       $clear=mysqli_query($db,"DELETE FROM cart WHERE cart_ip='{$_SERVER['REMOTE_ADDR']}'",MYSQLI_USE_RESULT);
       break;

       case 'delete':
              $delete=mysqli_query($db,"DELETE FROM cart WHERE cart_id='$id' AND cart_ip='{$_SERVER['REMOTE_ADDR']}'",MYSQLI_USE_RESULT);
              break;

    }
if (isset($_POST["submitdata"]))
{
	$_SESSION["order_delivery"]= $_POST["order_delivery"];
	$_SESSION["paymentMethod"]= $_POST["paymentMethod"];
	$_SESSION["oreder_name"]= $_POST["oreder_name"];
	$_SESSION["oreder_surname"]= $_POST["oreder_surname"];
	$_SESSION["oreder_email"]= $_POST["oreder_email"];
	$_SESSION["oreder_adress"]= $_POST["oreder_adress"];
	$_SESSION["oreder_comm"]= $_POST["oreder_xomm"];

}
 ?>

<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Shopping Cart</title>
	<meta name="description" content="" />
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

<!----------------------------------Case------------------------------->
 
 <?php
	$action=$_GET["action"];
		
		switch($action) {
				
			case 'showcart': ?>
           		
            <?php
	            $result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product");
				$row_cnt=mysqli_num_rows($result);
			if ($row_cnt>0)	
				{	
		?>
         <div class="steps">
				<a class="active" href="carten.php?action=showcart">Cart</a>
				<span>&rarr;</span>
				<a href="carten.php?action=confirm">Place your order</a>
				<div class="goToShop">
					<a href="carten.php?action=clear" alt="Очистити кошик">Clear all</a>
				</div>
			</div>
				<section class="productInCart">
            <div class="container">
                <div class="row emblem">
                    <div class="col-md-5 col-sm-5">Product</div>
                    <div class="col-md-2 col-sm-2">Price</div>
                    <div class="col-md-2 col-sm-2">Quontity</div>
                    <div class="col-md-2 col-sm-2">Total</div>
                    <div class="col-md-1 col-sm-1"></div>
                </div>
         
          <?php 
				while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $int=$myrow["price"]*$myrow["cart_count"];
                $all_price=$all_price+$int;
            ?>
             
              <hr>
              <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12">
                   <?php $size=$myrow["img_size"] ?>
                   <img src="../images/<?php echo $myrow["img"] ?>.png" alt="" class="<?php echo $size ?>">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <h2>
                        <?php echo $myrow["goods_name_en"];?>
                    </h2>
                    <?php echo $myrow["quontity"];?> g.
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span>
                        <?php echo $myrow["price"];?> UAH
                    </span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <?php $iid=$myrow['cart_id'];?>
                    <span>
                        <input id="input-id<?php echo $iid ?>" class="count-input" iid="<?php echo $iid ?>" type="text" value="<?php echo $myrow['cart_count'];?>" name="quontity" size="2">
                    </span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span id="product_price<?php echo $iid?>" price="<?php echo $myrow['cart_price']?>">
                        <?php echo $int ?> UAH
                    </span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-3">
                   <?php $del=$myrow['cart_id'];?>
					<a href="carten.php?id=<?php echo $del ?>&action=delete" alt="Удалить из корзины"><i class="fa fa-trash-o"></i></a>
                </div>
              </div>
              <?php } ?>
              <hr>
              <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-4">
                    <p>TOTAL:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-8">
                    <p>
                 <strong class="resultSum"> <?php echo $all_price; ?> </strong>UAH
                    </p>
                </div>
              </div>
               <div class="row">
               	<div class="confirm_clear">
                 	<a class="active confirmLnk" href="carten.php?action=confirm" alt="Оформити замовлення"> Confirm your order</a>
					<a class="continueLnk" href="en.php">Continue shopping</a>
               	</div>
			  </div>
            </div>
    </section>
		
	<?php	}
	else {
			echo	'<script type="text/javascript">
    			function func(){ 
        			history.go(0); 
					window.location.href = "carten.php?action=showcart
						return true;
        						};   
					setTimeout(func, 2000);
			</script>';
			echo '<div class="cartDef">';
				echo '<h4 class="notAdded">There is no goods in your cart</h4>';
				echo '<h4 class="notAdded">
					<a href="en.php"<>>>Back to Internet-shop<<</a>
				</h4>';
			echo'</div>';
		}	
			 break;?>
		
	<!-------------------------------CONFIRM-------------------------------->				
	<?php	case 'confirm':  ?>
	
			<div class="steps">
				<a  href="carten.php?action=showcart">Cart</a>
				<span>&rarr;</span>
				<a class="active" href="carten.php?action=confirm">Confirm your order</a>
			</div>
<!------------------------------Delivery PaymetMethod------------------->
<?php 
	if($_SESSION['order_delivery']=='Самовивіз') $chck1="checked";	
	if($_SESSION['order_delivery']=='Доствака "Новою Почшою"') $chck2="checked";
	if($_SESSION['order_delivery']=="Достака  кур'єром по Києву") $chck3="checked";	
	if($_SESSION['paymentMethod']=="Готівкою кур'єру") $chck4="checked";	
	if($_SESSION['paymentMethod']=='За допомогою банківської карти') $chck5="checked";
	if($_SESSION['paymentMethod']=="Достака  кур'єром по Києву") $chck6="Приват24";				
		?>
<form id="mainForm">			
			<section class="delivery paymentMethod">
		<div class="container">
			<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 15px;">
		 		<h3>Select a delivery method:*</h3>
		 		<hr>
			 		<div class="input-wrap">
			 			<input type="radio" name="order_delivery" value="Self-pickup" id="order_delivery1" <?php echo $chck1 ?> required>
				 		<label for="order_delivery1">Self-pickup (Kiev, Heroiv Stalinhradu Avenue, 10-A (Obolon metro st.)</label>
			 		</div>
				 	<div class="input-wrap">
				 		<input type="radio" name="order_delivery" value='"Nova Рoshta" delivery' id="order_delivery2" <?php echo $chck2 ?> required>
				 		<label for="order_delivery2">"Nova Рoshta" delivery</label>
				 		</div>
				 	
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 15px;">
				<h3>Select a payment method:*</h3>
				<hr>
					<div class="pay">

						<div class="input-wrap">
						<input type="radio" name="paymentMethod" id="paymentMethod1" value="bank card" <?php echo $chck4 ?> required>
				 		<label for="paymentMethod1">bank card 
				 		<img src="../img/Master-Card-Blue-icon.png" alt="Master Card" style="vertical-align:bottom;">
				 			<img src="../img/Visa-icon.png" alt="Visa" style="vertical-align:bottom;">
				 		</label>
						</div>

					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value='through "Nova Рoshta"' id="paymentMethod2" <?php echo $chck5 ?> required>
				 		<label for="paymentMethod2">through "Nova Рoshta"</label>
					</div>
					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value="cash in the shop" id="paymentMethod3" <?php echo $chck6 ?> required>
				 		<label for="paymentMethod3">cash in the shop</label>
					</div>	 
					</div>
				</div>	
			</div> 	
		</div>

	</section>

<!-------------------------MainForm-------------------->
	<section class="mainForm info">	
			<div class="container">
				<div class="row">
					<div class="agreementLink">
						<p>
							<input type="checkbox" name="agreement" value="yes" required> 
I agree to use my presonal data *. 
							<i id="down1"  class="fa fa-angle-down" onclick="slideDownDiv('#agreem'); hideArrow('up1','down1');"></i> 
							<i id="up1" class="fa fa-angle-up" onclick="slideUpDiv('#agreem');  hideArrow('up1','down1');"></i> 
						</p>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="agreement" id="agreem">
							<p>
							According to the Law of Ukraine "On Protection of Personal Data" from 01.06.2010, № 2297-VI of, I was informed that my personal data included in the database of personal data of Private Entrepreneur Senyk A.A., which are processed in an automated program 1C or MS Excel tables, electronic and on paper, and give its unequivocal consent to the processing of these personal data for the purpose of performance Private Entrepreneur Senyk A.A. its obligations in front of me as a consumer of goods.
							</p>
							<p>
						This consent is valid for 20 years. In the case of expiry or in case of my claim, I authorize Private Entrepreneur Senyk A.A. remove my personal data.
							</p>
							<p>
				I have read with the location database of personal data, its purpose, designation, rights, and conditions for the transfer of personal data to third parties.
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="mainForm">
							<h3>Please fill in your personal data:</h3>	
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_name"]?>" name="order_name" placeholder="Name*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_surname"]?>" name="order_surname" placeholder="Surname*" required>
				<input class="textbox " type="email" value="<?php echo $_SESSION["order_email"]?>" name="order_email" placeholder="Email*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_phone"]?>" name="order_phone" placeholder="Phone*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_adress"]?>" name="order_adress" placeholder="Adress/№ 'Новая Почта' department" >
				<textarea class="textbox" style="height: 90px;" name="order_comm" placeholder="Your comments" value="<?php echo $_SESSION["order_comm"]?>"></textarea>
				<?php 
					$micro = sprintf("%02d",(microtime(true) - floor(microtime(true))) * 10); // Ну раз что-то нужно добавить для полной уникализации то ..
					$number = date("His"); //Все вместе будет первой частью номера ордера
					$order_id = $number.$micro;
				$_SESSION["order_id"]=$order_id;
				?>
				<input type="hidden" value="<?php echo $_SESSION["order_id"] ?>" name="order_id"/>
				<input type="submit" value="Confirm your order" name="submitdata">
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<h3>Important information</h3>
						<ul>
							<li>* required fields</li>
							<li>After getting your order our manager will contact you to confirm your order.</li>
							<li>If the order is above 500 UAH, the delivery is free of charge.</li>
							<li>Pickup is made from the store at Kiev, Heroiv Stalinhradu Avenue, 10-A, (Obolon metro st.). Store phone # +380503824170,+380677735037.</li>
						</ul>
					</div>
				</div>
			</div>
	</form>		
<!-----------------FormEnd--------------------->
	</section>
</main>		
	<?php break; ?>	
	
	<!------------------------------THANKS-------------------------------->		
	<?php	case 'thanks': 
	include 'include/clear.php';
	?>
			<div class="cartDef">
				<h4 class="notAdded">Thank you for your order, our manager will contact you!</h4>
				<h4 class="notAdded">
					<a href="index.php">>>Back to Internet-shop<<</a>
				</h4>
			</div>	
			<?php break; ?>		
	<!---------------------------Payment---------------------------------->	
<?php	case 'payment':  
	
	$result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product");
				$total_sum=0;
		while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
				{
					$quontity=$myrow["cart_count"];
					$price=$myrow["cart_price"];
					$total_sum=$total_sum+($quontity*$price);
		}
				
?>

	<div class="pay_wraper">
		<div class="order_id">
			<label for="order_id">Your order Id:</label> <span class="orderId"><?php echo $_SESSION["order_id"] ?></span> 
			<input type="hidden" id="order_id" value="<?php echo $_SESSION["order_id"] ?>">
		</div>
		<div class="order">
		
			<ul>
			<?php $result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product"); 
				while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
				{ ?>
				<li><?php echo $myrow["goods_name_en"];  echo " "; echo $myrow["quontity"] ?>g. - <span class="quontity"><?php echo $myrow["cart_count"] ?></span></li> 
				<?php }?>
			</ul>
			
		</div>
		<hr>
		<div class="toPay">
			<label for="price">Your order price: <span class="totalSum"><?php echo $total_sum ?></span> UAH</label>
		</div>			
	<br>
	<input type="hidden" id="price" value="<?php echo $total_sum ?>">	
	<input type="hidden" id="descr" value="Товари ТМ Пінат">
		
	<button onclick="make_pay();" class="btn">To pay</button>
	</div>
<span id='form_responce' style='display:none;'>
<?php 
		include 'include/clear.php';			
					break; ?>	

<!------------------------DEFAULT----------------------------------->			
					
	<?php default:  ?>
		 
			<?php
	            $result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product");
				$row_cnt=mysqli_num_rows($result);
			if ($row_cnt>0)	
				{	
		?>
         <div class="steps">
				<a class="active" href="carten.php?action=showcart">Cart</a>
				<span>&rarr;</span>
				<a href="carten.php?action=confirm">Place your order</a>
				<div class="goToShop">
					<a href="carten.php?action=clear" alt="Очистити кошик">Clear all</a>
				</div>
			</div>
				<section class="productInCart">
            <div class="container">
                <div class="row emblem">
                    <div class="col-md-5 col-sm-5">Product</div>
                    <div class="col-md-2 col-sm-2">Price</div>
                    <div class="col-md-2 col-sm-2">Quontity</div>
                    <div class="col-md-2 col-sm-2">Total</div>
                    <div class="col-md-1 col-sm-1"></div>
                </div>
         
          <?php 
				while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $int=$myrow["price"]*$myrow["cart_count"];
                $all_price=$all_price+$int;
            ?>
             
              <hr>
              <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12">
                   <?php $size=$myrow["img_size"] ?>
                   <img src="../images/<?php echo $myrow["img"] ?>.png" alt="" class="<?php echo $size ?>">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <h2>
                        <?php echo $myrow["goods_name_en"];?>
                    </h2>
                    <?php echo $myrow["quontity"];?> g.
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span>
                        <?php echo $myrow["price"];?> UAH
                    </span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <?php $iid=$myrow['cart_id'];?>
                    <span>
                        <input id="input-id<?php echo $iid ?>" class="count-input" iid="<?php echo $iid ?>" type="text" value="<?php echo $myrow['cart_count'];?>" name="quontity" size="2">
                    </span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span id="product_price<?php echo $iid?>" price="<?php echo $myrow['cart_price']?>">
                        <?php echo $int ?> UAH
                    </span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-3">
                   <?php $del=$myrow['cart_id'];?>
					<a href="carten.php?id=<?php echo $del ?>&action=delete" alt="Удалить из корзины"><i class="fa fa-trash-o"></i></a>
                </div>
              </div>
              <?php } ?>
              <hr>
              <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-4">
                    <p>Всего:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-8">
                    <p>
                 <strong class="resultSum"> <?php echo $all_price; ?> </strong>UAH
                    </p>
                </div>
              </div>
               <div class="row">
               	<div class="confirm_clear">
                 	<a class="active confirmLnk" href="carten.php?action=confirm" alt="Оформити замовлення"> To place your order</a>
					<a class="continueLnk" href="en.php">Continue shopping</a>
               	</div>
			  </div>
            </div>
    </section>	
	<?php	}
	else {
			echo '<div class="cartDef">';
				echo '<h4 class="notAdded">There is no goods in your cart</h4>';
				echo '<h4 class="notAdded">
					<a href="en.php"<>>>Back to Internet-shop<<</a>
				</h4>';
			echo'</div>';
		}	
			 break;?>
				
	<?php break;
				
		
		}
	?>



 <!---------FormStart------{$_SERVER['REMOTE_ADDR']}----------->
 
	</main>
<!--------------------------FOOTER---------------------------->	
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
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
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