<?php

class ModeloLogin extends CI_Model{
   
    public function loginUser($email){
        $this->db->select('*');
        $this->db->where('email',$email);

        $query = $this->db->get('usuarios');

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return NULL;
        }
    }
}