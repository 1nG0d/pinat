<?php
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
	 include("../../blocks/db.php");
	 
	 $result=mysqli_query($db,"SELECT * FROM cart,goods WHERE cart.cart_ip ='{$_SERVER['REMOTE_ADDR']}' AND goods.goods_id=cart.cart_id_product");
	 $row_cnt=mysqli_num_rows($result);
			if ($row_cnt>0){
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				do {
					$count=$count+$myrow["cart_count"];
				}	
				while ($myrow=mysqli_fetch_array($result, MYSQLI_ASSOC));
				echo $count;
			}
				
	else {
		echo '0';
	}			
	
 }

?>