<?php
include("../blocks/db.php");


 function clear_string($clr_str)
 {
	 $clr_str=strip_tags($clr_str);
	 $clr_str=mysqli_real_escape_string($db,$clr_str);
	 $clr_str=trim($clr_str);
	 return $clr_str;
 }

?>