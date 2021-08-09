<?php

class ModeloApiYouTube extends CI_Model{

    public function getDatosUsuario($email){
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get('usuarios');

        if($query){
            return $query->result();
        }else{
            return NULL;
        }
    }

    
    public function getCategoriaPorNombre($titulo){
        $this->db->select('*');
        $this->db->where('titulo',$titulo);
        $query = $this->db->get('categorias');
        
        if($query){
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function crearCategoria($titulo, $idUsuario){
        $data = array(
            "titulo" => $titulo,
            "fk_usuario" => $idUsuario
        );
        $this->db->insert("categorias",$data);
    }


    public function crearVideos($id,$idCategoria){

        $sql = "SELECT id FROM videos WHERE id = ?";
        $resultado = $this->db->query($sql, [$id]);

        if(!($resultado->num_rows()>0)){
            $data = array(
                "id" => $id,
                "fk_categoria" => $idCategoria
            );
            $this->db->insert('videos', $data);
        }
    }

    public function getCategorias($idUsuario){
        //Recupero las categorias del usuario
        $sql = "SELECT titulo, id FROM categorias WHERE fk_usuario = ?";
        $categorias = $this->db->query($sql, [$idUsuario]);

        return $categorias;
    }

    public function getVideosSesion($idUsuario){
        /*
        $sql = "SELECT * FROM usuarios INNER JOIN categorias ON(usuarios.id=categorias.fk_usuario) INNER JOIN videos ON(categorias.id=videos.fk_categoria) WHERE usuario.id = ?";
        
        $resultado = $this->db->query($sql, [$idUsuario]);
        */

        /*
        $this->db->table('usuarios');
        $this->db->select('*');
        $this->db->join('categorias','categorias.fk_usuario = usuarios.id','inner');
        $this->db->join('videos','videos.fk_categoria = categoria.id','inner');
        $this->db->where('usuarios.id',$idUsuario);
        */
        $this->db->select('c.titulo,v.id');
        $this->db->from('usuarios u');
        $this->db->join('categorias c', 'u.id = c.fk_usuario');
        $this->db->join('videos v', 'c.id = v.fk_categoria');
        $this->db->where('u.id',$idUsuario);
    
        $aResult = $this->db->get();
    
        if(!$aResult->num_rows() == 1)
        {
            return false;
        }
    
        return $aResult->result_array();
        
    }

}