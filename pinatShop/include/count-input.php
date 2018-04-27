<?php
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
	 include("../../blocks/db.php");
	 $id=($_POST["id"]);
	 
	 $result=mysqli_query($db,"SELECT * FROM cart WHERE cart_id ='$id' AND cart_ip='{$_SERVER['REMOTE_ADDR']}'");
	 
	 $row_cnt=mysqli_num_rows($result);
			if ($row_cnt>0){
				$myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$new_count=(int)$_POST['count'];
				
				if($new_count>0){
					$update=mysqli_query($db,"UPDATE cart SET cart_count='$new_count' WHERE cart_id='$id' AND cart_ip='{$_SERVER['REMOTE_ADDR']}'");
					echo $new_count;
				}
				else {echo $myrow["cart_count"];}
	 }
 }

?>