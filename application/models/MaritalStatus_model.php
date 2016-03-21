<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmploymentType_model
 *
 * @author itischarles
 */
class MaritalStatus_model extends CI_Model {
    
    
     function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    function addMaritalStatus($content){
        
        $this->db->insert('marital_status', $content);
        return $this->db->insert_id();
    }
    
    function updateMaritalStatus($content, $where){
        $this->db->where($where);
        $this->db->update('marital_status', $content);
        return $this->db->affected_rows();
    }
    
    function getMaritalStatusByWhere($where){
        $this->db->where($where);
        return $this->db->get('marital_status')->row();
    }
    
    
    function getMaritalStatusByID($maritalStatusID){
        $this->db->where(array('maritalStatusID'=>(int)$maritalStatusID));
        return $this->db->get('marital_status')->row();
    }
   
    
    function listMaritalStatusByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('marital_status')->result();
    }
    
    
    function listActiveMaritalStatus(){       
        $this->db->where(array('maritalStatus_isActive'=>1));
        
        return $this->db->get('marital_status')->result();
    }
    
}
