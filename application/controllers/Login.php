<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function cargarVista(){
        $this->load->view('vistaLogin');
    }

    public function cargarHome(){
        $this->load->view('vistaPaginaPrincipal');
    }

    public function iniciarSesion(){
        $email = $this->input->post("email");

        /*Cargo el modelo y creo una instancia*/
        $this->load->model('modeloLogin','login');

        /*Traigo, a nivel servidor, los datos de la base de datos (en forma de array) que coinciden con lo ingresado o null en caso de no existir*/
        $arregloUsuario = $this->login->loginUser($email);

        if(is_null($arregloUsuario)){
            
            $data = array(
                'warning' => true,                
                'message' => 'El email ingresado no existe, ingrese un email correcto'
            );
                    
            $this->load->view('vistaLogin',$data);
        }else{

            foreach($arregloUsuario as $usu){
                $password = $this->input->post("password");
                $hash = $usu->password;

                if(password_verify($password,$hash)){
                   
                    $data = array(
                        'success' => true,                
                        'message' => 'Login exitoso'
                    );
    
                    $nombre = $usu->nombre;
                    $apellido = $usu->apellido;
    
                    $this->iniciarSesionServidor($email,$nombre,$apellido);
    
                    $this->load->view('vistaPaginaPrincipal',$data);
    
                }else{
                    $data = array(
                        'warning' => true,                
                        'message' => 'La contrasenia ingresada no coincide, ingrese la contrasenia correcta'
                    );
    
                    $this->load->view('vistaLogin',$data);
                }
            }

            

        }

    }

    public function iniciarSesionServidor($email,$nombre,$apellido){
        //Creo un array para guardar la informacion (en este caso, el email, nombre y apellido, estado de login) de la sesion
        $arraySesion = array(
            'email' => $email,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'estadoLogin' => TRUE
        );
        //Guardo el array en la sesion(ya cargada mediante el autoload de la configuracion) del codeigniter
        $this->session->set_userdata($arraySesion);
        
        print_r($arraySesion);
        print_r(session_status());
    }

}