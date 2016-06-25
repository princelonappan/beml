<?php

/**
 * @author 
 * @copyright 2014
 */
Class Like_model extends CI_Model
{
    
    public function get_like_details($user_id, $post_id)
    {
        $this->db->select('*');
        $this->db->from('like');
        $this->db->where('liked_by =', $user_id);
        $this->db->where('post_id =', $post_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function save_post_like($data)
    {
        try
        {
            $this->db->set($data);
            $this->db->insert('like');
            $last_id = $this->db->insert_id();
            return true;
            
        } catch (Exception $exc)
        {
            return false;
        }
    }
    
    public function unlike_post($post_id, $user_id)
    {
        try
        {
            $this->db->where('post_id', $post_id);
            $this->db->where('liked_by', $user_id);
            $this->db->delete('like');
            return true;
            
        } catch (Exception $exc)
        {
            return false;
        }
    }
}

?>