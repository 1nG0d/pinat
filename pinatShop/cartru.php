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
	<title>Корзина заказов</title>
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
				<a class="active" href="cartru.php?action=showcart">Корзина</a>
				<span>&rarr;</span>
				<a href="cartru.php?action=confirm">Оформление заказа</a>
				<div class="goToShop">
					<a href="cartru.php?action=clear" alt="Очистити кошик">Очистить</a>
				</div>
			</div>
				<section class="productInCart">
            <div class="container">
                <div class="row emblem">
                    <div class="col-md-5 col-sm-5">Продукт</div>
                    <div class="col-md-2 col-sm-2">Цена</div>
                    <div class="col-md-2 col-sm-2">Количество</div>
                    <div class="col-md-2 col-sm-2">Сумма</div>
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
                        <?php echo $myrow["goods_name_ru"];?>
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
					<a href="cartru.php?id=<?php echo $del ?>&action=delete" alt="Удалить из корзины"><i class="fa fa-trash-o"></i></a>
                </div>
              </div>
              <?php } ?>
              <hr>
              <div class="row ">
                <div class="col-md-9 col-sm-9 col-xs-4">
                    <p>Всего:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-8">
                    <p>
                 <strong class="resultSum"> <?php echo $all_price; ?> </strong> грн.
                    </p>
                </div>
              </div>
               <div class="row">
               	<div class="confirm_clear">
                 	<a class="active confirmLnk" href="cartru.php?action=confirm" alt="Оформити замовлення">Оформление заказа</a>
					<a class="continueLnk" href="index.php">Продолжить покупку</a>
               	</div>
			  </div>
            </div>
    </section>
		
	<?php	}
	else {
			echo	'<script type="text/javascript">
    			function func(){ 
        			history.go(0); 
					window.location.href = "cartru.php?action=showcart 
						return true;
        						};   
					setTimeout(func, 2000);
			</script>';
			echo '<div class="cartDef">';
				echo '<h4 class="notAdded">В корзине нету товаров</h4>';
				echo '<h4 class="notAdded">
					<a href="index.php"<>>>Вернуться обратно в Интернет-магазин<<</a>
				</h4>';
			echo'</div>';
		}	
			 break;?>
		
	<!-------------------------------CONFIRM-------------------------------->				
	<?php	case 'confirm':  ?>
	
			<div class="steps">
				<a  href="cartru.php?action=showcart">Корзина</a>
				<span>&rarr;</span>
				<a class="active" href="cartru.php?action=confirm">Оформление заказа</a>
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
		 		<h3>Выберите способ доставки:*</h3>
		 		<hr>
			 		<div class="input-wrap">
			 			<input type="radio" name="order_delivery" value="Самовивіз" id="order_delivery1" <?php echo $chck1 ?> required>
				 		<label for="order_delivery1">Самовывоз (г.Киев, просп.Героев Сталинграда,10-А, корп.2)</label>
			 		</div>
				 	<div class="input-wrap">
				 		<input type="radio" name="order_delivery" value='Доставка "Новою Поштою"' id="order_delivery2" <?php echo $chck2 ?> required>
				 		<label for="order_delivery2">Доставка "Новой Почтой" (при заказе от 500грн.-бесплатно)</label>
				 		</div>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 15px;">
				<h3>Выбирете сопособ оплаты:*</h3>
				<hr>
					<div class="pay">

						<div class="input-wrap">
						<input type="radio" name="paymentMethod" id="paymentMethod1" value="Сплати банківською картою" <?php echo $chck4 ?> required>
				 		<label for="paymentMethod1">Оплатить банковской картой (сейчас онлайн)
				 		<img src="../img/Master-Card-Blue-icon.png" alt="Master Card" style="vertical-align:bottom;">
				 			<img src="../img/Visa-icon.png" alt="Visa" style="vertical-align:bottom;">
				 		</label>
						</div>

					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value="Сплатити картою смс"' id="paymentMethod4" <?php echo $chck7 ?> required>
				 		<label for="paymentMethod4">Оплатить банковской картой (получить смс с номером карты) </label>
					</div>
					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value='Оплата через "Нову Пошту" или "Укрпочту"' id="paymentMethod2" <?php echo $chck5 ?> required>
				 		<label for="paymentMethod2">При получении заказа в отделении "Новой Почты" или "Укрпочты"</label>
					</div>
					<div class="input-wrap">
						<input type="radio" name="paymentMethod" value="Наличными в магазине" id="paymentMethod3" <?php echo $chck6 ?> required>
				 		<label for="paymentMethod3">Наличными в магазине</label>
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
							<input type="checkbox" name="agreement" value="yes" required> Я согласен ( -а ) на использование моих пресональних данных. *
							<i id="down1"  class="fa fa-angle-down" onclick="slideDownDiv('#agreem'); hideArrow('up1','down1');"></i> 
							<i id="up1" class="fa fa-angle-up" onclick="slideUpDiv('#agreem');  hideArrow('up1','down1');"></i> 
						</p>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="agreement" id="agreem">
							<p>
							Согласно Закона Украины «О защите персональных данных» от 01.06.2010 года № 2297-VI, я уведомлен(а), что мои персональные данные включены в базу персональных данных «Контрагенты» ФО-П Сенык А.А., которые обрабатываются в автоматизированной системе 1С или таблицах MS Excel, на электронных и на бумажных носителях, и даю свое однозначное согласие на обработку указанных персональных данных с целью исполнения ФО-П Сенык А.А. своих обязательств передо мной как потребителя товаров.
							</p>
							<p>
						Данное согласие действует на протяжении 20 лет. В случае окончания срока действия или в случае получения ФО-П Сенык А.А. моего требования, я уполномочиваю ФО-П Сенык А.А. удалить мои персональные данные.
							</p>
							<p>
				Я ознакомлен(а) с местонахождением базы персональных данных, ее назначением, наименованием, правами и условиями передачи моих персональных данных третьим лицам.
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="mainForm">
							<h3>Заполните пожалуйста ваши данные:</h3>	
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_name"]?>" name="order_name" placeholder="Имя*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_surname"]?>" name="order_surname" placeholder="Фамилия" required>
				<input class="textbox " type="email" value="<?php echo $_SESSION["order_email"]?>" name="order_email" placeholder="Email*" required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_phone"]?>" name="order_phone" placeholder="Телефон*  " required>
				<input class="textbox" type="text" value="<?php echo $_SESSION["order_adress"]?>" name="order_adress" placeholder="Адрес доставки/Номер 'Новой Почты'" >
				<textarea class="textbox" style="height: 90px;" name="order_comm" placeholder="Ваш комментарий" value="<?php echo $_SESSION["order_comm"]?>"></textarea>
				<?php 
					$micro = sprintf("%02d",(microtime(true) - floor(microtime(true))) * 10); // Ну раз что-то нужно добавить для полной уникализации то ..
					$number = date("His"); //Все вместе будет первой частью номера ордера
					$order_id = $number.$micro;
				$_SESSION["order_id"]=$order_id;
				?>
				<input type="hidden" value="<?php echo $_SESSION["order_id"] ?>" name="order_id"/>
				<div id="message"></div>
				<input type="submit" value="Подтвердите заказ" name="submitdata" onsubmit="ValidPhone();">
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<h3>Важная информация</h3>
						<ul>
							<li> * поля обязательные для заполнения. </li>
							<li> После оформления заказа наш менеджер свяжется с Вами для подтверждения заказа. </li>
							<li> Если заказ составляет от 500 грн., доставка - бесплатно. Доставка по Киеву 40грн. Если заказ от 250грн., доставка по Киеву - бесплатно.</li>
							<li> Самовывоз проводится из магазина по адресу г.Киев , просп.Героев Сталинграда, 10-А (рядом м.Оболонь). Перед самовывозом нужно уточнить наличие пасты в магазине по тел. +380503824170, +380677735037. </li>
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
				<h4 class="notAdded">Спасибо за сделаный заказ, сотрудники ТМ Пинат уже работают над Вашим заказом! </h4>
				<h4 class="notAdded">
					<a href="index.php">>>Продолжить покупки<<</a>
				</h4>
				<h4 class="notAdded">Давайте дружить :) Интересное тут 
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
			<label for="order_id">Номер вашего заказа:</label> <span class="orderId"><?php echo $_SESSION["order_id"] ?> </span> 
			<input type="hidden" id="order_id" value="<?php echo $_SESSION["order_id"] ?>">
		</div>
		<div class="order">
		
			<ul>
			<?php $result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product"); 
				while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
				{ ?>
				<li><?php echo $myrow["goods_name_ru"];  echo " "; echo $myrow["quontity"] ?>г. - <span class="quontity"><?php echo $myrow["cart_count"] ?></span></li> 
				<?php }?>
			</ul>
		</div>
		<hr>
		<div class="toPay">
			<label for="price">Cума вашего заказа : <span class="totalSum"><?php echo $total_sum ?></span> грн.</label>
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
				<a class="active" href="cartru.php?action=showcart">Корзина</a>
				<span>&rarr;</span>
				<a href="cartru.php?action=confirm">Оформление заказа</a>
				<div class="goToShop">
					<a href="cartru.php?action=clear" alt="Очистити кошик">Очистить</a>
				</div>
			</div>
				<section class="productInCart">
            <div class="container">
                <div class="row emblem">
                    <div class="col-md-5 col-sm-5">Продукт</div>
                    <div class="col-md-2 col-sm-2">Цена</div>
                    <div class="col-md-2 col-sm-2">Количество</div>
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
                <div class="col-md-2 col-sm-2 col-xs-12">
                      <?php $size=$myrow["img_size"] ?>
                   <img src="../images/<?php echo $myrow["img"] ?>.png" alt="" class="<?php echo $size ?>">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <h2>
                        <?php echo $myrow["goods_name_ru"];?>
                    </h2>
                    <?php echo $myrow["quontity"];?> грамм
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <span>
                        <?php echo $myrow["price"];?> грн.
                    </span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                    <?php $iid=$myrow['cart_id'];?>
                    <span>
                        <input id="input-id<?php echo $iid ?>" class="count-input" iid="<?php echo $iid ?>" type="text" value="<?php echo $myrow['cart_count'];?>" name="quontity" size="2">
                    </span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                    <span id="product_price<?php echo $iid?>" price="<?php echo $myrow['cart_price']?>">
                        <?php echo $int ?> грн.
                    </span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-6">
                   <?php $del=$myrow['cart_id'];?>
					
                    <a href="cartru.php?id=<?php echo $del ?>&action=delete" alt="далить из корзины"><i class="fa fa-trash-o"></i></a>
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
                 <strong class="resultSum"> <?php echo $all_price; ?> </strong>грн.
                    </p>
                </div>
              </div>
               <div class="row">
               	<div class="confirm_clear">
                 	<a class="active confirmLnk" href="cartru.php?action=confirm" alt="Оформити замовлення">Оформить заказ</a>
					<a class="continueLnk" href="index.php">Продолжить покупку</a>
               	</div>
			  </div>
            </div>
    </section>		
	<?php	}
	else {
			echo '<div class="cartDef">';
				echo '<h4 class="notAdded">В корзину не добавлено товаров</h4>';
				echo '<h4 class="notAdded">
					<a href="index.php"<>>>Вернуться в Интернет-магазин<<</a>
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
					<a href="../index.html#cooperation"><<Нажимайте сюда>></a>
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