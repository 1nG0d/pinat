<?php

$recepient = "shoppinat@gmail.com";
$sitename = "pinat.com.ua";

$name = trim($_GET["name"]);
$phone = trim($_GET["phone"]);
$email = trim($_GET["email"]);
$question = trim($_GET["question"]);

$pagetitle = "Нова заявка на співпрацю з сайту  \"$sitename\"";
$message = "Ім'я: $name \nТелефон: $phone \ne-mail: $email \nЗапитання: $question";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");