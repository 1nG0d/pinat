 <?php
 $db = mysqli_connect("pinat.mysql.ukraine.com.ua", "pinat_db", "Cngh93dH", "pinat_db");

if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
	}
$result = mysqli_query($db,"set names utf8",MYSQLI_USE_RESULT);
 ?> 