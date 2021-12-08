<?php

class Role {

    private $id_role;
    private $nama_role;
    
	
    function getIdRole() {
        return $this->id_role;
    }
    function getNamaRole(){
        return $this->nama_role;
    }
	
    function setIdUser($id_role) {
        $this->id_role = $id_role;
    }
    function setNamaRole($nama_role) {
        $this->nama_role = $nama_role;
    }
}