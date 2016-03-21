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
class EmploymentType_model extends CI_Model {
    
    
     function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    function addEmploymentType($content){
        
        $this->db->insert('employmentType', $content);
        return $this->db->insert_id();
    }
    
    function updateEmploymentType($content, $where){
        $this->db->where($where);
        $this->db->update('employmentType', $content);
        return $this->db->affected_rows();
    }
    
    function getEmploymentTypeByWhere($where){
        $this->db->where($where);
        return $this->db->get('employmentType')->row();
    }
    
    
    function getEmploymentTypeByID($employmentTypeID){
        $this->db->where(array('employmentTypeID'=>(int)$employmentTypeID));
        return $this->db->get('employmentType')->row();
    }
   
    
    function listEmploymentTypesByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('employmentType')->result();
    }
    
    
    function listActiveEmploymentTypes(){       
        $this->db->where(array('employmentTypeIsActive'=>1));
        
        return $this->db->get('employmentType')->result();
    }
    
}
