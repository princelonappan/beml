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
    
    public function get_favourite_posts($user_id, $pagination_limit, $offset)
    {
        $limit = $pagination_limit * $offset;
        $this->db->select('*, a.id as cat_id, favourite.post_id as post_id, a.category_name as category_name, p.created_date as post_created_date');
        $this->db->from('favourite');
        $this->db->join('post as p','p.id = favourite.post_id');
        $this->db->join('post_category as a','p.category_id = a.id');
        $this->db->where('favourite.user_id', $user_id);
        $this->db->order_by("favourite.created", "desc"); 
        $this->db->limit($pagination_limit, $limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function un_favourite_post($post_id, $user_id)
    {
        try
        {
            $this->db->where('post_id', $post_id);
            $this->db->where('user_id', $user_id);
            $this->db->delete('favourite');
            return true;
            
        } catch (Exception $exc)
        {
            return false;
        }
    }

}

?>