<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Estilo -->

        <!-- Mis estilos -->
        <link rel="stylesheet" href="<?php echo base_url().'css/styleLogin.css'?>">

        <!-- Estilos jquery ui -->
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.theme.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.structure.min.css'?>">
    
    <!-- Scripts  -->

        <!-- Scripts jquery + jquery ui -->
        <script src="<?php echo base_url().'js/jquery-3.6.0.min.js'?>"></script>
        <script src="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.js'?>"></script>

        <!-- Mis scripts -->


</head>
<body>
    <!-- Captura de errores -->
    <?php if( isset($warning) && $warning==true){ ?>
        <label class="warning"><?php echo $message; ?></label>
    <?php } ?>    
        
    <?php if( isset($success) && $success==true){ ?>
        <label class="success"><?php echo $message; ?></label>
    <?php } ?>
        
    <?php if( isset($error) && $error==true){ ?>
        <label class="error"><?php echo $message; ?></label>
    <?php } ?> 
    
    <!-- Sección principal -->
    <section id="global">

        <!-- Cabecera -->
        <header>
            <div id="logo">
                <h1>VideoTrend</h1>
                <h2>Login</h2>
            </div>

            <div class="clearfix"></div>

            <nav id="menu">
                <ul>
                    <li><a href="#">Crear una cuenta</a></li>
                    <li><a href="#">Olvide mi contraseña</a></li>
                    <li><a href="#">Acerca de nosotros</a></li>
                </ul>
            </nav>
        </header>

        <!-- Contenido -->
        <section id="contenido">
            
            <div id="parametros">
                <form method="post" action="<?php echo base_url().'index.php/Login/iniciarSesion' ?>" id="formulario">

                    <h2>Login</h2>
                    <hr>
                    
                    <label for="email">E-mail*</label>
                    <input type="email" name="email" placeholder="email@address.com" id="email" required>
                    <br><br>
    
                    <label for="password">Contraseña*</label>
                    <input type="password" name="password" placeholder="password" id="password" required>
                    <br><br>
                    <hr>
                    
                    <button class="boton" id="botonIniciarSesion">Iniciar Sesión</button>
                </form>
            </div>
        </section>

    </section>

    <!-- Pie de pagina -->
    <footer>
        <ul id="pie-paginas">
            <li><a href="https://www.youtube.com/">YouTube</a></li>
            <li><a href="https://www.ugd.edu.ar/">UGD</a></li>
            <li><a href="https://campusvirtual.ugd.edu.ar/">Campus Virtual</a></li>
        </ul>
    </footer>
</body>
</html>