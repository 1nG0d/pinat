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
	<title>Кошик замовлень</title>
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
							<a href="../ua.html#about">Про компанію</a>
							<a href="../ua.html#product">Продукція</a>
							<a href="../ua.html#cooperation">Співробітництво</a>	
						</div>
				
					
						<div class="logo_bg">
						 
							 <a href="../ua.html#up">
								 <img src="../img/logo_menu.png" alt="ТМ Пінат"></a>
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
					<a href="ua.php" class="internetShop">Інтернет-магазин</a>
							
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
				<a class="active" href="cart.php?action=showcart">Кошик</a>
				<span>&rarr;</span>
				<a href="cart.php?action=confirm">Оформлення замовлення</a>
				<div class="goToShop">
					<a href="cart.php?action=clear" alt="Очистити кошик">Очистити</a>
				</div>
			</div>
				<section class="productInCart">
            <div class="container">
                <div class="row emblem">
                    <div class="col-md-5 col-sm-5">Продукт</div>
                    <div class="col-md-2 col-sm-2">Ціна</div>
                    <div class="col-md-2 col-sm-2">Кількість</div>
                    <div class="col-md-2 col-sm-2">Сума</div>
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
                        <?php echo $myrow["goods_name"];?>
                    </h2>
                    <?php echo $myrow["quontity"];?> г.
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span>
                        <?php echo $myrow["price"];?> грн.
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
                        <?php echo $int ?> грн.
                    </span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-3">
                   <?php $del=$myrow['cart_id'];?>
					<a href="cart.php?id=<?php echo $del ?>&action=delete" alt="Видалити з корзини"><i class="fa fa-trash-o"></i></a>
                </div>
              </div>
              <?php } ?>
              <hr>
              <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-4">
                    <p>Всього:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-8">
                    <p>
                 <strong class="resultSum"> <?php echo $all_price; ?> </strong> грн.
                    </p>
                </div>
              </div>
               <div class="row">
               	<div class="confirm_clear">
                 	<a class="active confirmLnk" href="cart.php?action=confirm" alt="Оформити замовлення">Оформити замовлення</a>
					<a class="continueLnk" href="ua.php">Продовжити покупку</a>
               	</div>
			  </div>
           		
            </div>
    </section>
		
	<?php	}
	else {  
			echo	'<script type="text/javascript">
    			function func(){ 
        			history.go(0); 
					window.location.href = "cart.php?action=showcart"
						return true;
						
        						};   
								setTimeout(func, 1000);
			</script>';
				
			echo '<div class="cartDef">';
				echo '<h4 class="notAdded">В кошик не добавлено жодного товару</h4>';
				echo '<h4 class="notAdded">
					<a href="ua.php"<>>>Повернутися до Інтернет-магазину<<</a>
				</h4>';
			echo'</div>';
		}	
			 break;?>
		
	<!-------------------------------CONFIRM-------------------------------->				
	<?php	case 'confirm':  ?>
	
			<div class="steps">
				<a  href="cart.php?action=showcart">Кошик</a>
				<span>&rarr;</span>
				<a class="active" href="cart.php?action=confirm">Оформлення замовлення</a>
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
		 		<h3>Виберіть спосіб доставки:*</h3>
		 		<hr>
			 		<div class="input-wrap">
			 			<input type="radio" name="order_delivery" value="Самовивіз" id="order_delivery1" <?php echo $chck1 ?> required>
				 		<label for="order_delivery1">Самовивіз (м.Київ, просп.Героїв Сталінграду,10-А, корп.2)</label>
			 		</div>
				 	<div class="input-wrap">
				 		<input type="radio" name="order_delivery" value='Доствака "Новою Поштою"' id="order_delivery2" <?php echo $chck2 ?> required>
				 		<label for="order_delivery2">Доставка "Новою Поштою" (при замовленні від 500грн.-безкоштовно)</label>
				 		</div>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 15px;">
				<h3>Виберіть спосіб оплати:*</h3>
				<hr>
					<div class="pay">

						<div class="input-wrap">
						<input type="radio" name="paymentMethod" id="paymentMethod1" value="Сплати банківською картою" <?php echo $chck4 ?> required>
				 		<label for="paymentMethod1">Сплатити банківською картою (зараз онлайн) 
				 		
				 			<img src="../img/Master-Card-Blue-icon.png" alt="Master Card" style="vertical-align:bottom;">
				 			<img src="../img/Visa-icon.png" alt="Visa" style="vertical-align:bottom;">
				 		
				 		
				 		</label>
						</div>
						<div class="input-wrap">
						<input type="radio" name="paymentMethod" id="paymentMethod4" value="Сплати банківською картою смс" <?php echo $chck7 ?> required>
				 		<label for="paymentMethod4">Сплатити банківською картою (отримати смс з номером карти) </label>

					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value='Готівкою через "Нову Пошту"' id="paymentMethod2" <?php echo $chck5 ?> required>
				 		<label for="paymentMethod2">При отриманні замовлення у від. "Нової Пошти" або "Укрпошти"</label>
					</div>
					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value="Готівкою" id="paymentMethod3" <?php echo $chck6 ?> required>
				 		<label for="paymentMethod3">Готівкою в магазині</label>
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
							<input type="checkbox" name="agreement" value="yes" required> Я згодний(-а) на використання моїх пресональних данних.* 
							<i id="down1"  class="fa fa-angle-down" onclick="slideDownDiv('#agreem'); hideArrow('up1','down1');"></i> 
							<i id="up1" class="fa fa-angle-up" onclick="slideUpDiv('#agreem');  hideArrow('up1','down1');"></i> 
						</p>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="agreement" id="agreem">
							<p>
							Згідно Закону України «Про захист персональних даних» від 01.06.2010 року № 2297-VI, я повідомлений (а), що мої персональні дані включені в базу персональних даних «Контрагенти» ФО-П Сеник А.А., які обробляються в автоматизованій системі 1С або таблицях MS Excel, на електронних і на паперових носіях, і даю свою однозначну згоду на обробку зазначених персональних даних з метою виконання ФО-П Сеник А.А. своїх зобов'язань переді мною як споживача товарів.
							</p>
							<p>
						Дана згода діє протягом 20 років. У разі закінчення терміну дії або в разі отримання ФО-П Сеник А.А. моєї вимоги, я уповноважую ФО-П Сеник А.А. видалити мої персональні дані.
							</p>
							<p>
				Я ознайомлений(а) з місцезнаходженням бази персональних даних, її призначенням, найменуванням, правами і умовами передачі моїх персональних даних третім особам.
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="mainForm">
							<h3>Заповніть будь-ласка ваші дані:</h3>	
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_name"]?>" name="order_name" placeholder="Ім'я*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_surname"]?>" name="order_surname" placeholder="Прізвище*" required>
				<input class="textbox " type="email" value="<?php echo $_SESSION["order_email"]?>" name="order_email" placeholder="Email*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_phone"]?>" name="order_phone" placeholder="Телефон*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_adress"]?>" name="order_adress" placeholder="Ваша адреса/Номер 'Новой Пошти'" >
				<textarea class="textbox" style="height: 90px;" name="order_comm" placeholder="Ваш комментар" value="<?php echo $_SESSION["order_comm"]?>"></textarea>
				<?php 
					$micro = sprintf("%02d",(microtime(true) - floor(microtime(true))) * 10); // Ну раз что-то нужно добавить для полной уникализации то ..
					$number = date("His"); //Все вместе будет первой частью номера ордера
					$order_id = $number.$micro;
				$_SESSION["order_id"]=$order_id;
				?>			
				<input type="hidden" value="<?php echo $_SESSION["order_id"] ?>" name="order_id"/>
				<input type="submit" value="Підтвердити замовлення" name="submitdata">
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<h3>Важлива інформація</h3>
						<ul>
							<li>* поля обов'язкові до заповнення.</li>
							<li>Після оформлення замовлення наш менеджер зв'яжеться з Вами для підтвердження замовлення.</li>
						    <li>Якщо замовлення становить від 500 грн., доставка по Україні безкоштовна. Доставка по Києву 40грн. При замовленні від 250 грн. доставка по Києву безкоштовна.</li>
							<li>Самовивезення проводиться з магазину за адресою м.Київ, просп. Героїв Сталінграду, 10-А (поруч ст.м.Оболонь). Попередньо потрібно взнати наявність замовленої пасти в магазині за тел. +380503824170,+380677735037.</li>
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
				<h4 class="notAdded">Дякуємо за зроблене замовлення, співробітник ТМ Пінат зв'яжеться з Вами! </h4>
				<h4 class="notAdded">
					<a href="ua.php">>>Повернутися до покупок<<</a>
				</h4>
				<h4 class="notAdded">Давайте дружити :) Цікавинки тут 
						<a href="https://www.facebook.com/pastapinat/ "><img src="../img/facebook.png" alt="Ми в Facebook"></a>
						<a href="https://www.youtube.com/channel/UCzsqI3FwNWVfaZOTSKIYpfw?guided_help_flow=3"><img src="../img/youTube.png" alt="Ми на YouTube"></a>
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
			<label for="order_id">Номер вашого замовлення:</label> <span class="orderId"><?php echo $_SESSION["order_id"] ?></span> 
			<input type="hidden" id="order_id" value="<?php echo $_SESSION["order_id"] ?>">
		</div>
		<div class="order">
		
			<ul>
			<?php $result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product"); 
				while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
				{ ?>
				<li><?php echo $myrow["goods_name"];  echo " "; echo $myrow["quontity"] ?>г. - <span class="quontity"><?php echo $myrow["cart_count"] ?></span></li> 
				<?php }?>
			</ul>
			
		</div>
		<hr>
		
		<div class="toPay">
			<label for="price">Cума вашого замовлення: <span class="totalSum"><?php echo $total_sum ?></span> грн.</label>
		</div>			
	<br>
	<input type="hidden" id="price" value="<?php echo $total_sum ?>">	
	<input type="hidden" id="descr" value="Товари ТМ Пінат">
		
	<button onclick="make_pay();" class="btn">Оплатить</button>
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
				<a class="active" href="cart.php?action=showcart">Кошик</a>
				<span>&rarr;</span>
				<a href="cart.php?action=confirm">Оформлення замовлення</a>
				<div class="goToShop">
					<a href="cart.php?action=clear" alt="Очистити кошик">Очистити</a>
				</div>
			</div>
				<section class="productInCart">
            <div class="container">
                <div class="row emblem">
                    <div class="col-md-5 col-sm-5">Продукт</div>
                    <div class="col-md-2 col-sm-2">Ціна</div>
                    <div class="col-md-2 col-sm-2">Кількість</div>
                    <div class="col-md-2 col-sm-2">Сума</div>
                    <div class="col-md-1 col-sm-1"></div>
                </div>
         
          <?php 
				while ($myrow = mysqli_fetch_array($result, MYSQL_ASSOC)) {

                $int=$myrow["price"]*$myrow["cart_count"];
                $all_price=$all_price+$int;
            ?>
             
              <hr>
              <div class="row">
                <div class="col-md-2 col-xs-12">
                     <img src="../images/<?php echo $myrow["img"] ?>.png" alt="">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <h2>
                        <?php echo $myrow["goods_name"];?>
                    </h2>
                    <?php echo $myrow["quontity"];?> грамм
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span>
                        <?php echo $myrow["price"];?> грн.
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
                        <?php echo $int ?> грн.
                    </span>
                </div>
                <div class="col-md-1 col-sm- col-xs-3">
                   <?php $del=$myrow['cart_id'];?>
					
                    <a href="cart.php?id=<?php echo $del ?>&action=delete" alt="Видалити з корзини"><i class="fa fa-trash-o"></i></a>
                </div>
              </div>
              <?php } ?>
              <hr>
              <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-4">
                    <p>Всього:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-8">
                    <p>
                 <strong class="resultSum"> <?php echo $all_price; ?> </strong>грн.
                    </p>
                </div>
              </div>
               <div class="row">
               	<div class="confirm_clear">
                 	<a class="active confirmLnk" href="cart.php?action=confirm" alt="Оформити замовлення">Оформити замовлення</a>
					<a class="continueLnk" href="ua.php">Продовжити покупку</a>
               	</div>
			  </div>
            </div>
    </section>		
	<?php	}
	else {
			echo '<div class="cartDef">';
				echo '<h4 class="notAdded">В кошик не добавлено жодного товару</h4>';
				echo '<h4 class="notAdded">
					<a href="ua.php"<>>>Повернутися до Інтернет-магазину<<</a>
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
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
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