<?php

/**
 * @author 
 * @copyright 2014
 */
Class Post_comments_model extends CI_Model
{
    
    public function save_comment($data)
    {
        try
        {
            $this->db->set($data);
            $this->db->insert('post_comments');
            $last_id = $this->db->insert_id();
            return true;
            
        } catch (Exception $exc)
        {
            return false;
        }
    }
    
    public function get_post_comments($post_id, $pagination_limit, $offset)
    {
        $limit = $pagination_limit * $offset;
        $this->db->select('*, post_comments.created_date as post_commented_date');
        $this->db->from('post_comments');
        $this->db->join('users as u','post_comments.user_id = u.id');
        $this->db->where('post_comments.post_id', $post_id);
        $this->db->where('post_comments.status', 1);
        $this->db->order_by("post_comments.created_date", "desc"); 
        $this->db->limit($pagination_limit, $limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_post_comments($post_id)
    {
        $this->db->select('*, post_comments.created_date as post_commented_date,'
                . 'post_comments.id as post_comment_id,post_comments.status as post_comment_status');
        $this->db->from('post_comments');
        $this->db->join('users as u','post_comments.user_id = u.id');
        $this->db->where('post_comments.post_id', $post_id);
        $this->db->order_by("post_comments.created_date", "desc"); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function updated_post_comment($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('post_comments' ,$data);
    }
}

?>