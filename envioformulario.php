<?php


$name = $_POST["fullname"];

$email = $_POST["email"];

$subjet = $_POST["subject"];

$phone = $_POST["number"];

$message = $_POST["message"];


if (mail($para, $titulo, $mensaje, $cabeceras)){
    echo "se envio";
} else {
    echo "no se envio";
}


?>