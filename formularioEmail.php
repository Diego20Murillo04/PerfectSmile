<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfect Smile</title>
    <script src="https://kit.fontawesome.com/0eaecc8c33.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../estilos/imagenes/logo/PERFECT-favicon.ico" type="image/x-icon">
    <link href="./estilos/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/zcb5jci.css">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

</head>

<body>

    <body>
        <!--  Navbar -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container-fluid">
                <a class="logo navbar-brand" href="index.html"><img src="./estilos/imagenes/logo/perfect-logo.png"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="offcanvas-title" id="offcanvasNavbarLabel"></div>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="./formularioEmail.php">Consultation
                                    Online</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ContactUs">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pay Deposit</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="titulo">
            <p>Consultation Online</p>
        </div>


        <?php
    if (isset($_POST["enc"])) {
    
        $texto = "Nombre: " . $_POST['nombre'];
        $para  = 'andrex.palop@gmail.com';
    
        if (isset($_POST['c'])) {
    
            $texto .= "<br>Procedimientos: ";
            for ($i = 0; $i < count($_POST['c']); $i++) {
                $texto .= "<br>-" . $_POST['c'][$i];
            }
        }
        $texto .= "<br>Contacto: " . $_POST['tel'];
        $texto .= "<br>Email: " . $_POST['email'];
        $texto .= "<br>Do you smoke? " . $_POST['smo'];
        $texto .= "<br>Mensaje: " . wordwrap($_POST['mens'], 70, "<br>");
        //print_r($texto);
    
        // título
        $titulo = 'Consultation Online';
        $boundary = md5(time());
        $cabeceras  = "MIME-Version: 1.0\r\n";
        $cabeceras .= 'To: Luis <'.$para.">\r\n";
        $cabeceras .= 'From: ' . $_POST['email'] . "\r\n";
        $cabeceras .= 'Reply-To: ' . $_POST['email'] . "\r\n";
        $cabeceras .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
    
        // Cabeceras adicionales
    
        $mensaje               = "--$boundary\r\n";
        $mensaje               .= "Content-Type: text/html; charset=UTF-8\r\n";
        $mensaje               .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $mensaje               .= chunk_split(base64_encode($texto));
        $cadena_aleatoria = "==Multipart_Boundary_x" . md5(mt_Rand()) . "x";
    
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $file_tmp_name      = $_FILES['file']['tmp_name'][$key];
            $file_name          = $_FILES['file']['name'][$key];
            $file_size          = $_FILES['file']['size'][$key];
            $file_type          = $_FILES['file']['type'][$key];
            if (file_exists($tmp_name)) {
                if (is_uploaded_file($tmp_name)) {
    
                    $handle              = fopen($file_tmp_name, "r");
                    $content             = fread($handle, $file_size);
                    fclose($handle); //cierro el archivo
    
                    //Ahora la codificamos y la dividimos en líneas de longitud aceptables
                    $encoded_content  = chunk_split(base64_encode($content));
                }
    
                $mensaje               .= "--$boundary\r\n";
                $mensaje               .= "Content-Type: $file_type; name=" . $file_name . "\r\n";
                $mensaje               .= "Content-Disposition: attachment; filename=" . $file_name . "\r\n";
                $mensaje               .= "Content-Transfer-Encoding: base64\r\n";
                $mensaje               .= "X-Attachment-Id: " . $cadena_aleatoria . "\r\n\r\n";
                $mensaje               .= $encoded_content;
            }
        }
    
    
        // Enviarlo
        if (mail($para, $titulo, $mensaje, $cabeceras)) {
            echo "<script>
            alert('The message has been sent');
            </script>";
            
       } else {
            echo "<script>
            alert('The message couldn't be sent);
            </script>";
       }
    }
    ?>

        <div class="ContactUs">
         
            <div class="formulario">
                <form action="" class="form-floating" method="post" enctype="multipart/form-data">
                    <div class="row g-3">

                        <div class="form-floating col-12">
                            
                            <input class="form-control border border-primary" id="floatingInput" name="nombre" placeholder="Full Name" type="text" required>
                            <label for="floatingInput">Full Name</label>
                        </div>

                        <div class="col-12">
                            <span class="form-label">Do you have any of these procedures?</span><br>
                            <input type="checkbox" name="c[]" value="Crowns" class="form-check-input" id="c1">
                            <label for="c1" class="form-check-label">Crowns</label>
                            <input type="checkbox" name="c[]" value="Missing teeth/tooth" class="form-check-input" id="c2">
                            <label for="c2" class="form-check-label">Missing teeth/tooth</label>
                            <input type="checkbox" name="c[]" value="Bridges" class="form-check-input" id="c3">
                            <label for="c3" class="form-check-label">Bridges</label>
                            <input type="checkbox" name="c[]" value="Root canals" class="form-check-input" id="c4"><label for="c4" class="form-check-label">Root canals</label>
                        </div>

                        <div class="form-floating col-md-6">
                            <input class="form-control border border-primary" id="floatingInput" name="tel" placeholder="Contact number" type="number" /> 
                            <label for="floatingInput">Contact number</label>
                        </div>

                        <div class="form-floating col-md-6">
                            <input class="form-control border border-primary" id="floatingInput" name="email" placeholder="email@example.com" type="email" /> 
                            <label for="floatingInput">Email</label>
                        </div>

                        <div class="form-floating col-12">
                            <input class="form-control border border-primary" id="floatingInput" name="smo" placeholder="Do you smoke?" type="text" /> 
                            <label for="floatingInput">Do you smoke?</label>
                        </div>

                        <div class="form-floating col-12">
                            <textarea class="form-control border border-primary" cols="30" id="floatingTextarea2" name="mens" placeholder="Message" rows="10"></textarea>
                            <label for="floatingTextarea2">Please tell us, what would you like to improve on your smile?</label>
                        </div>
                        
                        <p>If you have difficulty submitting your online consultation, please email the photos of your teeth as shown on:</p>
                    </div>
                
            </div>

            <div class="formulario">

                <div class="imagenes row g-3">
                    <div class="contact">
                        <h4>Upload your Photos</h4>
                    </div>
                    <p class="textphotos">It's important for us that you upload clear photographs and capture all the angles as seen in the
                        following models. All photographs are confidential.</p>
                    <div class="imagen1 col-md-6">
                        <img src="./estilos/img consultation/fondo1.jpg" alt="" srcset="">
                        <input type="file" name="file[0]" id="">
                    </div>
                    <div class="imagen2 col-md-6">
                        <img src="./estilos/img consultation/fondo2.jpg" alt="" srcset="">
                        <input type="file" name="file[1]" id="">

                    </div>
                    <div class="imagen3 col-md-6">
                        <img src="./estilos/img consultation/fondo3.jpg" alt="" srcset="">
                        <input type="file" name="file[2]" id="">
                    </div>
                    <div class="imagen4 col-md-6">
                        <img src="./estilos/img consultation/fondo4.jpg" alt="" srcset="">
                        <input type="file" name="file[3]" id="">
                    </div>
                    <div class="imagen5 col-md-6">
                        <img src="./estilos/img consultation/fondo5.jpg" alt="" srcset="">
                        <input type="file" name="file[4]" id="">
                    </div>
                    <div class="imagen6 col-md-6">
                        <img src="./estilos/img consultation/fondo6.jpg" alt="" srcset="">
                        <input type="file" name="file[5]" id="">
                    </div>
                </div>
                
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary border-0" style="background: #202b70;" type="submit" name="enc">Send</button>
            </div>        
         </form>
        </div>

        <!--  footer  -->
        <footer class="footer">
            <div class="footerup">
                <div><b>Follow Us:</b>
                    <p><a href="https://www.instagram.com/perfectsmileexperience/" target:"_blank"><i
                                class="fab fa-instagram"></i></a><a href="">
                            <i class="fab fa-tiktok"></i></a> </p>
                    <p></p>
                </div>

                <div><b>Email:</b>

                    <p>perfectsmileexperience@gmail.com</p>
                </div>

                <div><b>Adress:</b>

                    <p>Medell&iacute;n - Colombia</p>
                </div>

                <div><b>Phone:</b>

                    <p>+57 3245832934</p>
                </div>
            </div>

            <div class="footerdown">
                <p class="copy">Copyright &copy; Perfect Smile Experience LLC | All Rights Reserved |<a
                        href="./ProductDisclaimer.html">Product Disclaimer </a></p>
                &nbsp;

                <p class="letrapequena">&ldquo;For informational purposes only. Please consult your dentist to see if
                    veneers are right for you. The Smile Session does not replace the need for a consultation with your
                    dentist. Individual cases and results may vary. Tooth or gum contouring may be necessary.&uml;</p>
            </div>
        </footer>
        <!--Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
        </script>
    </body>

</html>