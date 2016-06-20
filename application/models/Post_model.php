<?php

/**
 * @author 
 * @copyright 2014
 */
Class Post_model extends CI_Model
{
    
    public function get_post_by_id($post_id)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->where('id =', $post_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_post_by_category($category_id, $pagination_limit)
    {
        $this->db->select('*');
        $this->db->from('post');
        $this->db->where('id =', $post_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function update_post_details($post_id, $data)
    {
        $this->db->where('id', $post_id);
        $this->db->update('post' ,$data);
    }
}

?>