<?php

$recepient = "martseniuk.anton@gmail.com";
$sitename = "pinat.com.ua";

$name = trim($_POST["name"]);
$phone = trim($_POST["phone"]);
$email = trim($_POST["email"]);
$question = trim($_POST["question"]);
$file = $_POST["question"];

$pagetitle = "Нова заявка на співпрацю з сайту  \"$sitename\"";
$message = "Ім'я: $name \nТелефон: $phone \ne-mail: $email \nЗапитання: $question";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");