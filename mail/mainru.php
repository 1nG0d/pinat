<?php
   include("../blocks/db.php");
  
$var_date = date("Y-m-d H:i:s");
$paymentMethod=trim($_POST["paymentMethod"]);
$order_delivery=trim($_POST["order_delivery"]);
$name = trim($_POST["order_name"]);
$surname = trim($_POST["order_surname"]);
$phone = trim($_POST["order_phone"]);
$email = trim($_POST["order_email"]);
$adress = trim($_POST["order_adress"]);
$comm = trim($_POST["order_comm"]);
$total = trim($_POST["total"]);
$order_id = trim($_POST["order_id"]);
$email2="pasta.pinat@gmail.com";

$recepient = "shoppinat@gmail.com" . ", " ; //обратите внимание на запятую
$recepient .= "$email2";
$recepient2= "$email";
$sitename = "pinat.com.ua";



$pagetitle = "Нове замовлення на \"$sitename\"";
$pagetitle1 = "Ваш заказ с \"$sitename\"";
//-----------------------------------------------message for Pinat
$message .= "
<html>
	<head></head>
	<body>
	<p><strong>Номер замовлення: </strong>$order_id</p>
	<p><strong>Ім'я: </strong>$name  </p>
	<p><strong>Прізвище:</strong> $surname </p>
	<p><strong>Телефон:</strong> $phone </p>
	<p><strong>e-mail:</strong> $email </p>
	<p><strong>Адреса: </strong>$adress </p>
	<p><strong>Коментарій:</strong> $comm </p>
	<p><strong>Cпосіб оплати: </strong>$paymentMethod </p>
	<p><strong>Cпосіб доставки:</strong> $order_delivery </p>
	<p><strong>Коли зроблено замовлення: </strong>$var_date </p>
	<strong>Замовлення:
</body>
</html>
";
//-----------------------------------------------message for client
$messageCl .= "
<html>
	<head></head>
	<body>
	<p><strong>Номер заказа:</strong> $order_id</p>
	<p><strong>Имя:</strong> $name </p>
	<p><strong>Фамилия:</strong> $surname </p>
	<p><strong>Телефон:</strong> $phone  </p>
	<p><strong>e-mail:</strong> $email</p>
	<p><strong>Адресс:</strong> $adress</p>
	<p><strong>Cпособ оплаты:</strong> $paymentMethod</p>
	<p><strong>Cпособ доставки:</strong> $order_delivery</p>

	<strong>Заказ:</strong>
</body>
</html>
";

$result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id = cart.cart_id_product");
		$total_sum=0;
		while ($myrow = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
				{		
					echo $goods_name=$myrow["goods_name_ru"];
					echo $quontity=$myrow["cart_count"];
					echo $size=$myrow["quontity"];
					$price=$myrow["cart_price"];
					$total_sum=$total_sum+($quontity*$price);
					$message .="<p>$goods_name $size - $quontity;</p>";
					$messageCl .="<p>$goods_name $size - $quontity;</p>";
		}
				$message .="<p><strong>Сума замовленння: </strong>$total_sum грн.</p>";
				$messageCl .="<p><strong>К оплате:</strong> $total_sum грн.</p>";

mail($recepient, $pagetitle, $message, "Content-type: text/html; charset=\"utf-8\"\n From: $recepient");
mail($recepient2, $pagetitle1, $messageCl, "Content-type: text/html; charset=\"utf-8\"\n From: $recepient");
//$clear=mysqli_query($db,"DELETE FROM cart WHERE cart_ip='{$_SERVER['REMOTE_ADDR']}'",MYSQLI_USE_RESULT);

$add_to_db=mysqli_query($db,"INSERT INTO customers (name,surname,phone,email,adress,order_id) VALUES ('$name','$surname','$phone','$email','$adress','$order_id')");
?>