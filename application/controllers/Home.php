<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    //Funcion que valida que el email que se pretende ingresar en la modificacion no se encuentre ya almacenado en la BD o que no sea igual al email con el que esta logueado.
    public function validarEmailModificacion(){

        $emailModificado = $this->input->post('emailModificacion');

        $emailSesion = $this->session->userdata('email');

        //Cargamos el modelo y creamos una instancia
        $this->load->model('modeloHome', 'mhome');

        $arregloUsuario = $this->mhome->getUsuarioPorEmail($emailModificado);

        if($emailModificado==$emailSesion){
            $data = array(
                'warning' => true               
            );
        }else{
            if(count($arregloUsuario)>0){
                $data = array(
                    'warning' => true               
                );
            }else{
                $data = array(
                    'success' => true
                );  
            }
        }
                  
        echo json_encode($data);
    }

    //Funcion para modificar los datos de usuario
    public function modificarUsuario(){

        //Almaceno el email de la sesion para buscarlo en la BD y posteriormente modificarlo
        $emailSesion = $this->session->userdata('email');

        //Recibo los valores del formulario enviados desde el HTML mediante el metodo post
        $email = $this->input->post('emailModificacion');
        $password = $this->input->post('passwordModificacion');
        $nombre = $this->input->post('nombreModificacion');
        $apellido = $this->input->post('apellidoModificacion');
        $numeroTel= $this->input->post('telefonoModificacion');
        $paginaWeb = $this->input->post('paginaWebModificacion');
        $ciudad = $this->input->post('ciudadModificacion');
        $calle = $this->input->post('calleModificacion');
        $altura = $this->input->post('alturaModificacion');
        $longitud = $this->input->post('longitudModificacion');
        $latitud = $this->input->post('latitudModificacion');

        //Cargamos el modelo y creamos una instancia
        $this->load->model('modeloHome', 'mhome');

        $resultado = $this->mhome->modificarDatosUsuario($emailSesion, $email, $password, $nombre, $apellido, $numeroTel, $paginaWeb, $ciudad, $calle, $altura, $longitud, $latitud);

        if($resultado){
            echo "verdadero";
        }else{
            echo "falso";
        }
    }

    public function cerrarSesionDB(){
        //Devuelve true en caso de éxito o false en caso de error.
        $resultado = session_destroy();

        echo $resultado;
    }
}