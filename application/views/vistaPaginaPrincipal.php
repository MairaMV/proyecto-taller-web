<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Estilo -->

        <!-- Mis estilos -->
        <link rel="stylesheet" href="<?php echo base_url().'css/stylePaginaPrincipal.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'fonts/style.css'?>">

        <!-- Estilos jquery ui -->
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.theme.min.css'?>">
        <link rel="stylesheet" href="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.structure.min.css'?>">
    
    <!-- Scripts  -->

        <!-- Scripts jquery + jquery ui -->
        <script src="<?php echo base_url().'js/jquery-3.6.0.min.js'?>"></script>
        <script src="<?php echo base_url().'js/jquery-ui-1.12.1/jquery-ui.js'?>"></script>

        <!-- Scripts api youtube -->
        <script  src = " https://apis.google.com/js/api.js "></script>
        <script src="<?php echo base_url().'js/apiYouTube.js'?>"></script>

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
            <div id="cabecera">
                <div id="logo">
                    <h1>VideoTrends - Home</h1>
                </div>
    
                <div class="selectMenu">
                    <select name="menu" id="menuUsuario">
                        <option selected="" disabled="" id="nombre"> <?php echo $this->session->userdata("nombre") ?> </option>
                        <option value="modificar" id="modificar">Modificar Perfil</option>
                        <option value="cerrar" id="cerrar-sesion">Cerrar Sesión</option>
                    </select>
                </div>

                <form method="post">
                    <div id="dialogo" title="Modificación de perfil" style="text-align:center">
                        <p>E-mail</p>
                        <input type="email" name="emailModificacion" id="emailModificacion" onblur="validarEmailAModificar()"><span id="spanEmail"></span>
                        <br><br>
                        
                        <p>Contraseña</p>
                        <input type="password" name="passwordModificacion1" id="password1"><span id="span_pass"></span>
                        <br><br>
                        
                        <p>Repetir contraseña</p>
                        <input type="password" name="passwordModificacion2" id="password2" onblur="validarPassword()">
                        <br><br>
                        
                        <p>Nombre</p>
                        <input type="text" name="nombreModificacion" id="nombreModificacion">
                        <br><br>
                        
                        <p>Apellido</p>
                        <input type="text" name="apellidoModificacion" id="apellidoModificacion">
                        <br><br>
                        
                        <p>Número de Telefono</p>
                        <input type="tel" name="telefonoModificacion" id="telefonoModificacion">
                        <br><br>
                        
                        <p>Página WEB</p>
                        <input type="url" name="paginaWebModificacion" id="paginaWebModificacion">
                        <br><br>
                        
                        <p>Ciudad</p>
                        <select name="ciudadModificacion" id="ciudadModificacion" title="Seleccione ciudad">
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
                            <option value="El alcazar">El Alcazar</option>
                            <option value="Puerto rico">Puerto Rico</option>
                            <option value="Jardin america">Jardin America</option>
                            <option value="San ignacio">San Ignacio</option>
                            <option value="Eldorado">Eldorado</option>
                            <option value="Posadas">Posadas</option>
                            <option value="Obera">Oberá</option>
                            <option value="Iguazu">Iguazú</option>
                        </select>
                        <br><br>
                    
                        <p>Calle</p>
                        <input type="text" name="calleModificacion" id="calleModificacion">
                        <br><br>
                        
                        <p>Altura (número)</p>
                        <input type="text" name="alturaModificacion" id="alturaModificacion">
                        <br><br>
                    
                        <p>Coordenadas</p>
                        <input type="number" name="latitudModificacion" class="coordenadas" id="latitudModificacion" placeholder="Latitud">
                        <br><br>
                        <input type="number" name="longitudModificacion" class="coordenadas" id="longitudModificacion" placeholder="Longitud">
                        <br><br>

                        <button id="boton-guardar">Guardar</button>
                    </div>
                </form>
                
            </div>

            <nav>
                <div id="tituloNav">
                    <label>Titulo</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Ingrese titulo del video">
                </div>
                <div id="busquedaNav">
                    <label>Terminos de busqueda</label>
                    <input type="text" name="terminoBusqueda" id="terminoBusqueda" placeholder="Ingrese terminos de busqueda">
                    <button type="submit" class="icon-search" id="buscar" onclick="search()"></button>
                </div>
                <div class="radios">
                    <label>Filtrar busqueda por:</label>
                    
                        <input type="radio" name="order" id="date" value="date" onchange="setFiltro('date')">
                        <span>Fecha de subida</span>
                        <input type="radio" name="order" id="relevence" value="relevance" onchange="setFiltro   ('relevance')">
                        <span>Relevancia</span>
                        <input type="radio" name="order" id="viewCount" value="viewCount" onchange="setFiltro   ('viewCount')">
                        <span>Numero de visualizaciones</span>
                        <input type="radio" name="order" id="rating" value="rating" onchange="setFiltro('rating')">
                        <span>Puntuacion</span>
                        <input type="hidden" name="" id="orderVal" >
                </div>
            </nav>

           

            <div class="clearfix"></div>
        </header>

        <!-- Contenido -->
        <section id="contenido">
            <div id="search-result">
                <ul class="resultadoGrilla" id="sortable">
                </ul>
            </div>

            <div class="clearfix"></div>

            <div id="acordion">
            </div>
        </section>

    </section>  

    <div class="clearfix"></div>
    
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