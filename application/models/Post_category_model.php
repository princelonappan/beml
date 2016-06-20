<?php

/**
 * @author 
 * @copyright 2014
 */
Class Post_category_model extends CI_Model
{
    
    public function get_categories()
    {
        $this->db->select('*');
        $this->db->from('post_category');
        $this->db->where('status =', '1');
        $query = $this->db->get();
        return $query->result();
    }
}

?>