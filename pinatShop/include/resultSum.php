<?php
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
	 include("../../blocks/db.php");
	 
	 $result=mysqli_query($db,"SELECT * FROM cart WHERE cart_ip ='{$_SERVER['REMOTE_ADDR']}'");
	 $row_cnt=mysqli_num_rows($result);
			if ($row_cnt>0){
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				do {
					$int=$int+($myrow["cart_price"] *$myrow["cart_count"]);
				}	
				while ($myrow=mysqli_fetch_array($result, MYSQLI_ASSOC));
				echo $int;
	}	
	
 }

?>