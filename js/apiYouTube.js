$(document).ready(function () {
  $("#sortable").sortable({
    connectWith: "ul",
    remove: function( event, ui ) {
			insertarVideosDB();
		}
  });
  
  //hacemos que los videos sean drageables
  $("#sortable").draggable();

  cargarVideosDelUsuario();

});

function start() {
	// Inicializa el cliente con la clave API y la API Translate.
	gapi.client.init({
		'apiKey': 'AIzaSyDpchwdcAQ0sRLsJxC7raguMNuVIyM3AcY',
		'discoveryDocs': ['https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest'],
	}).then(function() {
		//Ejecuta una solicitud de API y devuelve una promise.
		//The method name `language.translations.list` comes from the API discovery.
		return gapi.client.youtube.search.list({
			q: 'cats',
			part: 'snippet',
		});
	}).then(function(response) {
	}, function(reason) {
		console.log('Error: ' + reason.result.error.message);
	});
};

// Carga la biblioteca de cliente de JavaScript e invoca start después
gapi.load('client', start);

var idVideo ="";
var matrizBusquedaPrincipal = [];
var matrizBusquedaMas1 = [];
var matrizBusquedaMas2 = [];
var tituloBusqueda = "";
var tituloAnterior = "";
var numeroBusqueda = false;

// Search for a specified string.
function search(str_page) {
	var q = $('#titulo').val().concat(" ").concat($('#terminoBusqueda').val());
	
  var order = $('#orderVal').val();

  var request = gapi.client.youtube.search.list({
		q: q,
		part: 'snippet',
    order:order,
		maxResults: 20
	});
  
  request.execute(function(response) {
    //Almaceno el resultado en una variable
    var videosRetornados = response.result;
    //Almaceno el titulo de busqueda para luego crear el acordion
    tituloBusqueda = $('#titulo').val();
    //Creo los arreglos en donde voy a guardar el resultado para luego ponerlos en una grilla. 
    matrizBusquedaPrincipal = [];
    matrizBusquedaMas1 = [];
    matrizBusquedaMas2 = [];

    //invocamos a la funcion que va a eliminar la grilla de videos en caso de que sea una nueva busqueda. Si es la primera no hace nada.
    if(numeroBusqueda == true){
      eliminarGrilla();
    }

    $.each(videosRetornados.items , function(index, item) { 

      idVideo = item.id.videoId;
      if(index<10){
        //cargamos el video en el arreglo de busqueda principal
        matrizBusquedaPrincipal.push(idVideo);
      }else{
        if(index<15){
          //cargamos el video en el arreglo de la primera busqueda mas
          matrizBusquedaMas1.push(idVideo);
        }else{
          //cargamos el video en el arreglo de la segunda busqueda mas
          matrizBusquedaMas2.push(idVideo);
        }
      }
    });	
    
    //invocamos a la funcion que carga la matriz principal
    cargarMatrizPrincipal();

    //invocamos a la funcion que va a crear el acordeon con el titulo de la busqueda.
    //controlamos que el titulo ya no se haya creado antes.(de lo contrario podriamos tener dos o mas acordiones con el mismo titulo)
    if(tituloBusqueda != tituloAnterior){
        tituloAnterior = tituloBusqueda;
        crearAcordion();
    }

  });

}

function cargarMatrizPrincipal(){
  
  for(i=0 ; i<10 ; i++){
    $("#sortable").append('<li class="ui-state-default" id="resul"><iframe id='+matrizBusquedaPrincipal[i]+' width="200px" height="100px" type="text/html" src="https://www.youtube.com/embed/'+ matrizBusquedaPrincipal[i]+'"></iframe></li>');

    numeroBusqueda = true;
  }

  //habilitamos y creamos el boton para agregar 10 videos mas
  $("#sortable").append('<button id="buscarMas" class="icon-plus" onclick="cargarMatrizBusquedaMas1()"></button>');

}

function cargarMatrizBusquedaMas1(){
  
  for(i=0 ; i<5 ; i++){
    $("#sortable").append('<li class="ui-state-default" id="resul"><iframe id='+matrizBusquedaMas1[i]+' width="200px" height="100px" type="text/html" src="https://www.youtube.com/embed/'+ matrizBusquedaMas1[i]+'"></iframe></li>');
  }

  $("#buscarMas").remove();
  //habilitamos y creamos el boton para agregar 10 videos mas
  $("#sortable").append('<button id="buscarMas" class="icon-plus" onclick="cargarMatrizBusquedaMas2()"></button>');
}

function cargarMatrizBusquedaMas2(){
  
  for(i=0 ; i<5 ; i++){
    $("#sortable").append('<li class="ui-state-default" id="resul"><iframe id='+matrizBusquedaMas2[i]+' width="200px" height="100px" type="text/html" src="https://www.youtube.com/embed/'+ matrizBusquedaMas2[i]+'"></iframe></li>');
  }

  $("#buscarMas").remove();
}

function eliminarGrilla(){
  $(".resultadoGrilla").empty();
}

function crearAcordion(){
  
  $("#acordion").append('<div class="acordiones"><h2 id="">'+tituloBusqueda+'</h2><div><ul class="resultadoGrillaAcordion"></ul></div></div>');

  $(".acordiones").accordion({
    collapsible: true
  });

  $(".resultadoGrillaAcordion").sortable({
    connectWith: "ul"
  });
}

function insertarVideosDB(){

  var videos = [];
  var tituloBuscado = "";
  var id = "";

	$(".acordiones").each(function(i){
	  
    tituloBuscado = $(this).find("h2").text();
    
    $(this).find("iframe").each(function(){
      
      id = $(this).attr("id");

      videos.push({tituloBuscado:tituloBuscado, idVideo: id})
    });
	}); 

  console.log(videos);

	$.ajax({
		type: "POST",
		url: "http://localhost/taller/index.php/ApiYouTube/insertarVideoDB",
		data: {videos:videos},
		success: function (msg) {

      //alert(msg);
      // if(msg != ""){
      //   alert("Almacenamiento exitoso");
      // }else{
      //   alert("No se almaceno, algo paso");
      // }  
		}
	});

}

function cargarVideosDelUsuario(){

	var datosDB;
  var listaTitulos = [];

	$.ajax({
		type: "GET",
		url: "http://localhost/taller/index.php/ApiYouTube/recuperarVideosDB",
		success: function (response) {

      alert(response);
			datosDB = JSON.parse(response);
      
			$.each(datosDB, function (i, item) { 
        //inArray busca un valor especificado dentro de una matriz y devuelve su índice (o -1 si no se encuentra)
				if(($.inArray(item.titulo, listaTitulos))==-1){
					listaTitulos.push(item.titulo);
				}
			});

			$.each(listaTitulos, function (i, item) { 
				$("#acordion").append('<div class="acordiones"><h2 id="">'+item+'</h2><div><ul class="resultadoGrillaAcordion" id='+item+'></ul></div></div>');
			}); 

			$(".acordiones").accordion({
        collapsible: true
      });

      $(".resultadoGrillaAcordion").sortable({
        connectWith: "ul"
      });
           
			$(".acordiones").each(function () {
				var tituloVideo= $(this).find("h2").text();

				$.each(datosDB, function (i, item) { 
					if(item.titulo==tituloVideo){                
						$("#"+tituloVideo).append('<li class="ui-state-default" id="resul"><iframe id='+item.id+' height="100" width="200" type="text/html"  src="https://www.youtube.com/embed/'+item.id+'"></iframe></li>');
					}
				});

			});
		}
	});

}

function setFiltro(valFiltro){
  $('#orderVal').val(valFiltro);
}
