<?php
   include("../blocks/db.php");
  
$clear=mysqli_query($db,"DELETE FROM cart WHERE cart_ip='{$_SERVER['REMOTE_ADDR']}'",MYSQLI_USE_RESULT);

?>