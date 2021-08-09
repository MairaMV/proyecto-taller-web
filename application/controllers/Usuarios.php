<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function cargarVista(){
        $this->load->view('vistaRegistroUsuario');

        /*Probar si conectaba con la base de datos */
        // $this->load->model('modeloUsuario','usuario');
        // $this->usuario->probarCargar();
    }

    public function nuevoUsuario(){

        /*Recibo los valores del formulario enviados desde el HTML mediante el metodo post */
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $genero = $this->input->post('genero');
        $numeroTel= $this->input->post('telefono');
        $fechaNacim = $this->input->post('fecha');
        $paginaWeb = $this->input->post('pagina');
        $pais = $this->input->post('pais');
        $provincia = $this->input->post('provincia');
        $ciudad = $this->input->post('ciudad');
        $calle = $this->input->post('calle');
        $altura = $this->input->post('altura');
        $longitud = $this->input->post('longitud');
        $latitud = $this->input->post('latitud');

        /*Cargo el modelo*/
        $this->load->model('modeloUsuario','usuario');

        /*Valido que el email no exista antes de almacenarlo, a nivel de servidor*/
        $arregloUsuarios = $this->usuario->getUsuarioPorEmail($email);

        if(count($arregloUsuarios)>0){
            
            $data = array(
                'warning' => true,                
                'message' => 'El usuario ingresado ya existe'
            );
                    
            $this->load->view('vistaRegistroUsuario',$data);

        }else{
            $result = $this->usuario->altaUsuario($email,$password,$nombre,$apellido,$genero,$numeroTel,
                                                     $fechaNacim,$paginaWeb,$pais,$provincia,$ciudad,$calle,
                                                     $altura,$latitud,$longitud);

            /*Si el resultado de la insercion es verdadero quiere decir que el usuario se agrego correctamente*/
            if($result == true){
                $data = array(
                    'success' => true,                
                    'message' => 'Usuario registrado correctamente'
                );
                
                $this->load->view('vistaLogin',$data);
    
            }else{        
                $data = array(
                    'error' => true,                
                    'message' => 'Error al intentar registrar el usuario'
                );
                        
                $this->load->view('vistaRegistroUsuario',$data);
            }                               
        }
    }

    public function validarEmail(){ 

        //Almaceno el correo ingresado en el formulario mediante el metodo POST
        $email = $this->input->post('email');

        /*Cargo el modelo*/
        $this->load->model('modeloUsuario','usuario');

        /*Valido que el email no exista antes de almacenarlo, a nivel de servidor*/
        $arregloUsuarios = $this->usuario->getUsuarioPorEmail($email);

        if(count($arregloUsuarios)>0){
            
            $data = array(
            'base_url' => base_url(),
            'warning' => true,                
            'message' => 'Ya existe un usuario registrado con el correo ingresado'
            );
                   
        }else{
                    
            $data = array(
            'base_url' => base_url(),
            'success' => true,                
            'message' => 'Email validado con exito'
            );                
        }
                
        echo json_encode($data);
    }
    
}