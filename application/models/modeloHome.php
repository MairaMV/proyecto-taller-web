<?php

class ModeloHome extends CI_Model{

    public function getUsuarioPorEmail ($email){
        $this->db->select('email');
        $this->db->where('email',$email);
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    public function modificarDatosUsuario($emailSesion, $email, $password, $nombre, $apellido, $numeroTel, $paginaWeb, $ciudad, $calle, $altura, $longitud, $latitud){

        $hash = password_hash($password,PASSWORD_DEFAULT,[20]);

        /*Creo la estructura de datos con los parametros pasados en la funcion */
        $data = array(
            'email' => $email,
            'password' => $hash,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'numeroTel' => $numeroTel,
            'paginaWeb' => $paginaWeb,
            'ciudad' => $ciudad,
            'calle' => $calle,
            'altura' => $altura,
            'latitud' => $latitud,
            'longitud' => $longitud
        );

        $this->db->where('email', $emailSesion);
		
        //update devuelve true si la modificacion fue exitosa o false en caso de error
        return $this->db->update('usuarios', $data);
    }
}