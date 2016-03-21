<?php


/**
 * Description of Title_model
 * manage the title table
 * @author itischarles
 */
class Title_model extends CI_Model {
    
    
     function __construct() {
        parent::__construct();
    }
    
    
    
    
    
    function addNewTitle($content){
        
        $this->db->insert('title', $content);
        return $this->db->insert_id();
    }
    
    function updateTitle($content, $where){
        $this->db->where($where);
        $this->db->update('title', $content);
        return $this->db->affected_rows();
    }
    
    function getTitleByWhere($where){
        $this->db->where($where);
        return $this->db->get('title')->row();
    }
    
    
    function getTitleByID($titleID){
        $this->db->where(array('titleID'=>(int)$titleID));
        return $this->db->get('title')->row();
    }


    
    
    function listTitleByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('title')->result();
    }
    
    
    function listTitleActiveTitles(){       
        $this->db->where(array('titleIsActive'=>1));
        
        return $this->db->get('title')->result();
    }
    
}
