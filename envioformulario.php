<?php

var_dump($_POST);

$name = $_POST["fullname"];

$email = $_POST["email"];

$subjet = $_POST["subject"];

$phone = $_POST["number"];

$message = $_POST["message"];

echo $name." ".$email. " " .$subjet." ".$phone. " ".$message;

mail($para, $titulo, $mensaje, $cabeceras);

$para

?>