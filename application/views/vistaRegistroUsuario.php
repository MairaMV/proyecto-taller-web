<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>

    <!-- Estilo -->

        <!-- Mis estilos -->
        <link rel="stylesheet" href="<?php echo base_url().'css/styleRegistro.css'?>">

        <!-- Estilos jquery ui -->
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.theme.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.structure.min.css'?>">
    
    <!-- Scripts  -->

        <!-- Scripts jquery + jquery ui -->
        <script src="<?php echo base_url().'js/jquery-3.6.0.min.js'?>"></script>
        <script src="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.js'?>"></script>

        <!-- Mis scripts -->
        <script src="<?php echo base_url().'js/script.js'?>"></script>
        

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
                <h2>Registro de Usuarios</h2>
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

            <aside id="barra-lateral">
                <div id="imagen" >
                    <p><img id="img" src="<?php echo base_url().'img/imagen3.png'?>" alt="YouTube 1"></p>
                </div>
                <div id="txtAceptaCondiciones">
                    <p>Al hacer click en "Crear mi cuenta", aceptas las Condiciones y confirmas que leiste nuestras
                    políticas de datos, incluso el uso de cookies.</p>
                </div> 
            </aside>

            <div id="parametros">
                <form  method="post" action="<?php echo base_url().'index.php/Usuarios/nuevoUsuario'?>" id="formulario">
                    <h2>Datos de Inicio de Sesión</h2>
                    
                    <label for="email">E-mail*</label>
                    <input type="email" name="email" id="email"  placeholder="Ingrese email"  onblur="validarEmailAjax()" required>
                    <span id="emailValido" title="Validacion de email"><p>Email valido</p></span>
                    <span id="emailInvalido" title="Validacion de email"><p>Email ya existente</p></span>
                    <br><br>
    
                    <label for="password">Contraseña*</label>
                    <input type="password" name="password" id="password1" placeholder="Ingrese contraseña" required>
                    <br><br>

                    <label for="password">Repetir Contraseña*</label>
                    <input type="password" name="password" id="password2" onblur="validarPassword()" placeholder="Repita contraseña" required>
                    <span id="span_pass"></span>
                    <br><br>

                    <h2>Datos personales</h2>

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre">
                    <br><br>

                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Ingrese apellido">
                    <br><br>

                    <p id="genero">Género</p>
                        <label class="radio" title="Seleccione genero">
                            <span>
                              <input type="radio" value="Femenino" name="genero" id="femenino"/>
                              <span></span>
                            </span>
                            <span>Femenino</span>
                        </label>
                          
                        <label class="radio" title="Seleccione genero">
                            <span>
                              <input type="radio" value="Masculino" name="genero" id="masculino"/>
                              <span></span>
                            </span>
                            <span>Masculino</span>
                        </label>
    
                        <label class="radio" title="Seleccione genero">
                            <span>
                              <input type="radio" value="Otro" name="genero" id="otro-sex"/>
                              <span></span>
                            </span>
                            <span>Otro</span>
                        </label>
                    <br><br>

                    <label for="telefono">Número de Telefono</label>
                    <input type="tel" name="telefono" id="telefono" placeholder="Ingrese telefono">
                    <br><br>

                    <label for="fecha">Fecha de Nacimiento</label>
                    <input type="text" name="fecha" id="fecha-nacimiento">
                    <br><br>

                    <label for="pagina">Página WEB</label>
                    <input type="url" name="pagina" id="paginaWeb" placeholder="Ingrese pagina web">
                    <br><br>

                    <h2>Datos de Localización</h2>

                    <label for="pais">Pais</label>
                    <select name="pais" id="pais" title="Seleccione pais">
                        <option value="AF">Afganistán</option>
                        <option value="AL">Albania</option>
                        <option value="DE">Alemania</option>
                        <option value="AO">Angola</option>
                        <option value="AQ">Antártida</option>
                        <option value="AG">Antigua y Barbuda</option>
                        <option value="SA">Arabia Saudí</option>
                        <option value="DZ">Argelia</option>
                        <option value="AR" selected>Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="BS">Bahamas</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BE">Bélgica</option>
                        <option value="BZ">Belice</option>
                        <option value="BO">Bolivia</option>
                        <option value="BR">Brasil</option>
                        <option value="BG">Bulgaria</option>
                        <option value="KH">Camboya</option>
                        <option value="CM">Camerún</option>
                        <option value="CA">Canadá</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                        <option value="CO">Colombia</option>
                        <option value="KR">Corea</option>
                        <option value="KP">Corea del Norte</option>
                        <option value="CI">Costa de Marfíl</option>
                        <option value="CR">Costa Rica</option>
                        <option value="HR">Croacia</option>
                        <option value="CU">Cuba</option>
                        <option value="DK">Dinamarca</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egipto</option>
                        <option value="SV">El Salvador</option>
                        <option value="AE">Emiratos Árabes Unidos</option>
                        <option value="ES">España</option>
                        <option value="US">Estados Unidos</option>
                        <option value="PH">Filipinas</option>
                        <option value="FI">Finlandia</option>
                        <option value="FR">Francia</option>
                        <option value="GR">Grecia</option>
                        <option value="GT">Guatemala</option>
                        <option value="GY">Guayana</option>
                        <option value="GF">Guayana Francesa</option>
                        <option value="GN">Guinea</option>
                        <option value="HT">Haití</option>
                        <option value="HN">Honduras</option>
                        <option value="HU">Hungría</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IQ">Irak</option>
                        <option value="IR">Irán</option>
                        <option value="IE">Irlanda</option>
                        <option value="IS">Islandia</option>
                        <option value="FK">Islas Malvinas</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italia</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japón</option>>
                        <option value="LV">Letonia</option>
                        <option value="LB">Líbano</option>
                        <option value="LR">Liberia</option>
                        <option value="LT">Lituania</option>
                        <option value="MY">Malasia</option>
                        <option value="MX">México</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NG">Nigeria</option>
                        <option value="NL">Países Bajos</option>
                        <option value="PA">Panamá</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Perú</option>
                        <option value="PL">Polonia</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="UK">Reino Unido</option>
                        <option value="CZ">República Checa</option>
                        <option value="ZA">República de Sudáfrica</option>
                        <option value="DO">República Dominicana</option>
                        <option value="RO">Rumania</option>
                        <option value="RU">Rusia</option>
                        <option value="SN">Senegal</option>
                        <option value="SY">Siria</option>
                        <option value="SO">Somalia</option>
                        <option value="SD">Sudán</option>
                        <option value="SE">Suecia</option>
                        <option value="CH">Suiza</option>
                        <option value="TH">Tailandia</option>
                        <option value="TW">Taiwán</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TO">Tonga</option>
                        <option value="TR">Turquía</option>
                        <option value="UA">Ucrania</option>
                        <option value="UY">Uruguay</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                    </select>
                    <br><br>

                    <label for="provincia">Provincia</label>
                    <select name="provincia" id="provincia" title="Seleccione provincia">
                        <option value="Buenos Aires">Buenos Aires</option>
                        <option value="Buenos Aires Capital">Buenos Aires Capital</option>
                        <option value="Catamarca">Catamarca</option>
                        <option value="Chaco">Chaco</option>
                        <option value="Chubut">Chubut</option>
                        <option value="Cordoba">Cordoba</option>
                        <option value="Corrientes">Corrientes</option>
                        <option value="Entre Rios">Entre Rios</option>
                        <option value="Formosa">Formosa</option>
                        <option value="Jujuy">Jujuy</option>
                        <option value="La Pampa">La Pampa</option>
                        <option value="La Rioja">La Rioja</option>
                        <option value="Mendoza">Mendoza</option>
                        <option value="Misiones" selected>Misiones</option>
                        <option value="Neuquen">Neuquen</option>
                        <option value="Rio Negro">Rio Negro</option>
                        <option value="Salta">Salta</option>
                        <option value="San Juan">San Juan</option>
                        <option value="San Luis">San Luis</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Santa Fe">Santa Fe</option>
                        <option value="Santiago del Estero">Santiago del Estero</option>
                        <option value="Tierra del Fuego">Tierra del Fuego</option>
                        <option value="Tucuman">Tucuman</option>
                    </select>
                    <br><br>

                    <label for="ciudad">Ciudad</label>
                    <select name="ciudad" id="ciudad" title="Seleccione ciudad">
                        <option value="25 de mayo">25 de Mayo</option>
                        <option value="9 de julio">9 de julio</option>
                        <option value="Alba posse">Alba Posse</option>
                        <option value="Almafuerte">Almafuerte</option>
                        <option value="Apostoles">Apóstoles</option>
                        <option value="Aristobulo del valle">Aristobulo del Valle</option>
                        <option value="Azara">Azara</option>
                        <option value="Bernardo de irigoyen">Bernardo de Irigoyen</option>
                        <option value="Campo grande">Campo Grande</option>
                        <option value="Campo ramon">Campo Ramon</option>
                        <option value="Campo viera">Campo Viera</option>
                        <option value="Candelaria">Candelaria</option>
                        <option value="Capiovi">Capiovi</option>
                        <option value="Caraguatay">Caraguatay</option>
                        <option value="El alcazar" selected>El Alcazar</option>
                        <option value="Puerto rico">Puerto Rico</option>
                        <option value="Jardin america">Jardin America</option>
                        <option value="San ignacio">San Ignacio</option>
                        <option value="Eldorado">Eldorado</option>
                        <option value="Posadas">Posadas</option>
                        <option value="Obera">Oberá</option>
                        <option value="Iguazu">Iguazú</option>
                    </select>
                    <br><br>

                    <label for="calle">Calle</label>
                    <input type="text" name="calle" id="calle" placeholder="Ingrese calle">
                    <br><br>

                    <label for="altura">Altura (número)</label>
                    <input type="text" name="altura" id="altura" placeholder="Ingrese altura">
                    <br><br>

                    <label for="coordenadas">Coordenadas</label>
                    <input type="number" name="latitud" class="coordenadas" id="latitud" placeholder="Latitud"><span>Lat.</span>
                    <input type="number" name="longitud" class="coordenadas" id="longitud" placeholder="Longitud"><span>Long.</span>

                    <input type="submit" class="boton" id="boton-crear" value="Registrar">

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