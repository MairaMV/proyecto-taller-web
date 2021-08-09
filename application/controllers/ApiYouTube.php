<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiYouTube extends CI_Controller {


    public function insertarVideoDB(){

        $codigo=$_POST["videos"];

        $datos = json_decode(json_encode($codigo,true));

        //Recuperamos el email de la sesion para luego buscar el id del usuario para la fk
        $emailSesion = $this->session->userdata('email');

        //Cargamos el modelo y creamos una instancia
        $this->load->model('modeloApiYouTube', 'mapi');

        //Recuperamos los datos del usuario
        $datosUsuario = $this->mapi->getDatosUsuario($emailSesion);

        //Almacenamos el id del usuario recuperado
        foreach($datosUsuario as $du){
            $idUsuario = $du->id;
        }

        foreach($datos as $vd){
            //Almacenamos el nombre de la categoria con el titulo enviado
            $nombreCategoria = $vd->tituloBuscado;
            
            //Antes de crear la categoria, verificamos que esta no exista.
            $verificacionCategoria = $this->mapi->getCategoriaPorNombre($nombreCategoria);

            if(count($verificacionCategoria)>0){
                
                //Recuperamos los datos de la categoria para luego obtener el id
                $datosCategoria = $this->mapi->getCategoriaPorNombre($nombreCategoria);

                //Almacenamos el id de la categoria
                foreach($datosCategoria as $dc){
                    $idCategoria = $dc->id;
                }

            }else{
                //La categoria no existe, entonces hay que crearla
                $this->mapi->crearCategoria($nombreCategoria,$idUsuario);

                //Recuperamos los datos de la categoria para luego obtener el id
                $datosCategoria = $this->mapi->getCategoriaPorNombre($nombreCategoria);

                //Almacenamos el id de la categoria
                foreach($datosCategoria as $dc){
                    $idCategoria = $dc->id;
                }
            }
            $this->mapi->crearVideos($vd->idVideo,$idCategoria);
        }
  
    }
    
    public function recuperarVideosDB(){
        
        //Recuperamos el email de la sesion para luego buscar el id del usuario para la fk
        $emailSesion = $this->session->userdata('email');

        //Cargamos el modelo y creamos una instancia
        $this->load->model('modeloApiYouTube', 'mapi');

        //Recuperamos los datos del usuario
        $datosUsuario = $this->mapi->getDatosUsuario($emailSesion);

        //Almacenamos el id del usuario recuperado
        foreach($datosUsuario as $du){
            $idUsuario = $du->id;
        }

        $datosADevolver =$this->mapi->getVideosSesion($idUsuario); 

        $datos = json_encode($datosADevolver);
        echo $datos;
    }

}