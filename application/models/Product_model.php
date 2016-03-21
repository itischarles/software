<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wrapper_model
 *manages accesses to the wrapper tables, product, product options and wrapper rules
 * @author itischarles
 */
class Product_model extends CI_Model{
 
     function __construct() {
        parent::__construct();
    }
    

    
    function addNewProduct($content){
        
        $this->db->insert('products', $content);
        return $this->db->insert_id();
    }
    
    function updateProduct($content, $where){
        $this->db->where($where);
        $this->db->update('products', $content);
        return $this->db->affected_rows();
    }
    
    function getRecordByWhere($where){
        $this->db->where($where);
        return $this->db->get('products')->row();
    }
    
    
    function getRcordByID($productID){
        $this->db->where(array('productID'=>(int)$productID));
        return $this->db->get('products')->row();
    }

    
     function getRecordByURL($productBaseUrl){
        $this->db->where(array('productBaseUrl'=>$productBaseUrl));
        return $this->db->get('products')->row();
    }
    
    function getDetailsByWhere($where = false){      
       $this->db->join('advisers', 'clients.advisers_adviserID = advisers.adviserID','LEFT');
       $this->db->join('users', 'users.userID = advisers.users_userID', 'LEFT');
       $this->db->join('title', 'clients.title_titleID = title.titleID', 'LEFT');
       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('products')->row();
    }

    
    function listproductsByWhere($where = false){       
        if($where !== false):
            $this->db->where($where);
        endif;
        
        return $this->db->get('products')->result();
    }
    
    
    
    /**
     * get the client details and allows for pagination
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @param bol $count if true, it means we want the num_rows
     * @return type
     */
    function searchWrapperDetails($where, $limit = 0, $offset=0, $count=false){
      //  $this->db->join('clients_products','clients_products.clients_clientID = clients.clientID','LEFT');
      //  $this->db->join('products','clients_products.products_productID = products.productID','LEFT');
        
      if(empty($where)):
	    return false;
	endif;
	
	$filter = implode(" AND ", $where);

	$this->db->where($filter);
	
	if($count === true):	
	    return $this->db->count_all_results("products");
	endif;   
	$this->db->group_by('products.productID');
        $this->db->limit( $limit,$offset);
        return $this->db->get('products')->result();
    }
    
    
    /**
     * generate this key which will be used to view the client's profile page as oopose to using ID
     */
    function generateUrl(){
         $lastEntry = 
                $this->db
                ->order_by('productID','DESC')
                ->limit(1)
                ->get('products')
                ->row();        
        return md5(!empty($lastEntry) ? $lastEntry->productID : 0 );
    }
    
    
    
    
    
    /**************************************************************************
     *		    PRODUCT OPTIONS
     **************************************************************************/

    function addNewProductOption($content){
        
        $this->db->insert('product_options', $content);
        return $this->db->insert_id();
    }
    
    function updateProductOption($content, $where){
        $this->db->where($where);
        $this->db->update('product_options', $content);
        return $this->db->affected_rows();
    }
 
    function getProductOptionByWhere($where){
       $this->db->where($where);
        return $this->db->get('product_options')->row();
    }
    
    
    function listproductOptionsByWhere($where){       
        $this->db->join('products','product_options.products_productID = products.productID','LEFT');
        
        $this->db->where($where);
        return $this->db->get('product_options')->result();
    }
    
}
