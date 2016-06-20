<?php

/**
 * @author 
 * @copyright 2014
 */
Class Favourite_model extends CI_Model
{

    public function get_favourite_details($user_id, $post_id)
    {
        $this->db->select('*');
        $this->db->from('favourite');
        $this->db->where('user_id =', $user_id);
        $this->db->where('post_id =', $post_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function save_post_favourite($data)
    {
        try
        {
            $this->db->set($data);
            $this->db->insert('favourite');
            $last_id = $this->db->insert_id();
            return true;
        } catch (Exception $exc)
        {
            return false;
        }
    }

}

?>