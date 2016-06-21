<?php

/**
 * @author 
 * @copyright 2014
 */
Class Offices_model extends CI_Model
{
    
    public function get_offices()
    {
        $this->db->select('*');
        $this->db->from('offices');
        $query = $this->db->get();
        return $query->result();
    }
}

?>