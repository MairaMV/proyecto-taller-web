<?php

class ModeloUsuario extends CI_Model{

    /* Usuarios */

    public function getUsuarioPorEmail ($email){
        $this->db->select('email');
        $this->db->where('email',$email);
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    // public function probarCargar(){
    //     $data = array(
    //         'email' => "maira_mica@gmail.com",
    //         'nombre' => "Maira",
    //         'apellido' => "Valenzuela"
    //     );

    //     $this->db->insert('usuarios',$data);
    // }

    public function altaUsuario ($email,$password,$nombre,$apellido,$genero,$numeroTel,
                                 $fechaNacim,$paginaWeb,$pais,$provincia,$ciudad,$calle,
                                 $altura,$latitud,$longitud){
        
        /*La API de hash de contraseñas proporciona una envoltura fácil de usar sobre crypt() para hacer sencilla la creación y administración de contraseñas de una forma segura.

        password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash fuerte de único sentido.
        */

        $hash = password_hash($password,PASSWORD_DEFAULT,[20]);

        
        /*Creo la estructura de datos con los parametros pasados en la funcion */
        $data = array(
            'email' => $email,
            'password' => $hash,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'genero' => $genero,
            'numeroTel' => $numeroTel,
            'fechaNacim' => $fechaNacim,
            'paginaWeb' => $paginaWeb,
            'pais' => $pais,
            'provincia' => $provincia,
            'ciudad' => $ciudad,
            'calle' => $calle,
            'altura' => $altura,
            'latitud' => $latitud,
            'longitud' => $longitud
        );

        /*Inserto la estructura de datos en la base de datos y almaceno el resultado de la insercion para devolverlo al controlador*/
        $result = $this->db->insert('usuarios', $data);
        return $result;
    }
}