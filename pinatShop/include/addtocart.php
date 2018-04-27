<?php
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
	 include("../../blocks/db.php");
	 $id=($_POST["id"]);
	 $result=mysqli_query($db,"SELECT * FROM cart WHERE cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND cart_id_product='$id'");
	 $row_cnt=mysqli_num_rows($result);
			if ($row_cnt>0){
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$new_count=$myrow["cart_count"]+1;
				$update=mysqli_query($db,"UPDATE cart SET cart_count='$new_count' WHERE cart_ip='{$_SERVER['REMOTE_ADDR']}' AND cart_id_product='$id'");
			}
	 else
	 {
		$result=mysqli_query($db,"SELECT * FROM goods WHERE goods_id='$id'");
		$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$insert=mysqli_query($db,"INSERT cart(cart_id_product,cart_price,cart_datetime,cart_ip)
		 							VALUES(
											'".$myrow['goods_id']."',
											'".$myrow['price']."',
											NOW(),
											'".$_SERVER['REMOTE_ADDR']."'
									)	 ");
	 }
 }

?>