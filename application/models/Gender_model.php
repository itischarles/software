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
class Gender_model extends CI_Model {
    
    
     function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    function addGender($content){
        
        $this->db->insert('gender', $content);
        return $this->db->insert_id();
    }
    
    function updateGender($content, $where){
        $this->db->where($where);
        $this->db->update('gender', $content);
        return $this->db->affected_rows();
    }
    
    function getGenderByWhere($where){
        $this->db->where($where);
        return $this->db->get('gender')->row();
    }
    
    
    function getGenderByID($genderID){
        $this->db->where(array('genderID'=>(int)$genderID));
        return $this->db->get('gender')->row();
    }
   
    
    function listGendersByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('gender')->result();
    }
    
    
    function listActiveGenders(){       
        $this->db->where(array('genderIsActive'=>1));
        
        return $this->db->get('gender')->result();
    }
    
}
