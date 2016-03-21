<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Country_model
 *
 * @author itischarles
 */
class Country_model extends CI_Model {
    
    
     function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    function addNewCountry($content){
        
        $this->db->insert('countries', $content);
        return $this->db->insert_id();
    }
    
    function updateCountry($content, $where){
        $this->db->where($where);
        $this->db->update('countries', $content);
        return $this->db->affected_rows();
    }
    
    function getCountryByWhere($where){
        $this->db->where($where);
        return $this->db->get('countries')->row();
    }
    
    
    function getCountryByID($countryID){
        $this->db->where(array('countryID'=>(int)$countryID));
        return $this->db->get('countries')->row();
    }

    function getCountryByAlpha2($Alpha2){
        $this->db->where(array('countryAlpha2'=>$Alpha2));
        return $this->db->get('countries')->row();
    }
    
    
    function listCountriesByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('countries')->result();
    }
    

    
}
