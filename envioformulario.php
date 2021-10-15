<?php


$name = $_POST["fullname"];

$email = $_POST["email"];

$subjet = $_POST["subject"];

$phone = $_POST["number"];

$message = $_POST["message"];

$para = "perfectsmileexperience@gmail.com";

        $cabeceras  = "MIME-Version: 1.0\r\n";
        $cabeceras .= 'To: Perfect Smile <'.$para.">\r\n";
        $cabeceras .= 'From: ' .$email. "\r\n";
        $cabeceras .= 'Reply-To: ' .$email. "\r\n";
        $cabeceras .= 'Content-type: text/html; charset= utf-8';
        
$mensaje =$name. "<br>" .$email. "<br>" .$phone. "<br>" .$message;
        
if (mail($para, $subjet, $mensaje, $cabeceras)){
    echo "<script>alert('The message has been sent.');
    location.href='index.html';
    </script>";
    
} else {
    echo "<script>alert('The message couldn't be sent.);
    location.href='index.html';
    </script>";
}


?>