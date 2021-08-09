$(document).ready(function () {

    //Scripts REGISTRO DE USUARIO

        //DatePicker
        $("#fecha-nacimiento").datepicker({
            dateFormat: "yy-mm-dd"
        });


        $("#emailValido").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                "Cerrar": function () {
                $(this).dialog("close");
                }
            }
        });

        $("#emailInvalido").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                "Cerrar": function () {
                $(this).dialog("close");
                }
            }
        });


    //Scripts HOME PAGE

        //SelectMenu + Icono
        $('#menuUsuario').selectmenu({
            icons : {button:" ui-icon-gear"},
            width: 200,
        });

        //Dialogo de modificacion
        $('#menuUsuario').selectmenu({
            select: function(event, ui){
                if(ui.item.value=="modificar"){
                  $("#dialogo").dialog("open");
                }
            }
        });

        //Cerrar Sesion
        $('#menuUsuario').selectmenu({
            select: function(event, ui){
                if(ui.item.value=="cerrar"){
                  $.ajax({
                    type: "GET",
		            url: "http://localhost/taller/index.php/Home/cerrarSesionDB",
		            success: function (response) {
                        if(response){
                            window.location.replace("http://localhost/taller/index.php/Login/cargarVista");
                        }else{
                            alert("No se pudo cerrar la sesion");
                        }
                    }
                  });
                }
            }
        });
        
        $('#dialogo').dialog({
            autoOpen: false,
            draggable: false,
            width: 500,
            height: 500,
            modal: true
        });
    

        $('#boton-guardar').click( function( event ) {
            event.preventDefault();

            console.log("entra");

            //Almaceno los datos que voy a enviar mediante ajax
            var emailModificacion = $('#emailModificacion').val();
            var passwordModificacion = $('#password1').val();
            var nombreModificacion = $('#nombreModificacion').val();
            var apellidoModificacion = $('#apellidoModificacion').val();
            var telefonoModificacion = $('#telefonoModificacion').val();
            var paginaWebModificacion = $('#paginaWebModificacion').val();
            var ciudadModificacion = $('#ciudadModificacion').val();
            var calleModificacion = $('#calleModificacion').val();
            var alturaModificacion = $('#alturaModificacion').val();
            var longitudModificacion = $('#longitudModificacion').val();
            var latitudModificacion = $('#latitudModificacion').val();


            //Si los campos no estan vacios
            if(emailModificacion == "" || passwordModificacion == "" || nombreModificacion == "" || apellidoModificacion == "" ||   telefonoModificacion == "" || paginaWebModificacion == "" || ciudadModificacion == "" || calleModificacion == "" ||  alturaModificacion == "" || longitudModificacion == "" || latitudModificacion == ""){

            console.log("Campos incompletos");

            alert("Debe completar todos los campos");

            $(this).prop('disabled', true);

            }else{
        
                $.ajax({
                    type: "post",
                    url: "../Home/modificarUsuario",
                    data: {emailModificacion, passwordModificacion, nombreModificacion, apellidoModificacion, telefonoModificacion, paginaWebModificacion, ciudadModificacion, calleModificacion, alturaModificacion, longitudModificacion, latitudModificacion},
                    success: function (msg) {

                        if(msg == "verdadero"){
                            alert("Modificacion exitosa");
                            console.log("Modificacion exitosa")
                            $("#dialogo").dialog( "close" );
                            window.location.replace("http://localhost/taller/index.php/Login/cargarVista");
                        }else{
                            alert("No se pudo modificar al usario");
                            console.log("No se pudo modificar el usuario")
                        }   
                    }
                });
            }

        });

});

//Script de validación de la existencia de email a través de AJAX
function validarEmailAjax() {
    $.ajax({
        method: "POST",
        url: "validarEmail",
        data: {email: $('#email').val()}
    }).done(function( msg ) {

        var data=JSON.parse(msg);

        if(data.warning){
            $('#emailInvalido').dialog("open");
            $('#boton-crear').prop('disabled', true);
        }

        if(data.success){
            $('#emailValido').dialog("open");
            $('#boton-crear').prop('disabled', false);
        }
    });
}

//Script para validar que las contrasenias sean iguales
function validarPassword(){
    var password1 = $('#password1').val();
    var password2 = $('#password2').val();

    if(password1 != password2){
        $('#span_pass').text("Las contraseñas no coinciden");
        $('#span_pass').css({ 'color': 'red'});
        $('#boton-crear').prop('disabled', true); 
    }else{
        $('#span_pass').text("Las contraseñas coinciden");
        $('#span_pass').css({ 'color': 'green'});
        $('#boton-crear').prop('disabled', false);
    }
}

//Validar que el nuevo email ingresado ya no se encuentre almacenado en la BD
function validarEmailAModificar(){
    $.ajax({
        method: "POST",
        url: "../Home/validarEmailModificacion",
        data: {emailModificacion: $('#emailModificacion').val()}
    }).done(function( msg ) {
        var data=JSON.parse(msg);

        if(data.warning){
            $('#spanEmail').text("E-mail no válido");
            $('#spanEmail').css({ 'color': 'red'});
        }

        if(data.success){
            $('#spanEmail').text("E-mail válido");
            $('#spanEmail').css({ 'color': 'green'});
        }
    });                  
}

    