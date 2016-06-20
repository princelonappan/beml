<?php

/**
 * @author 
 * @copyright 2014
 */
Class Post_comments_model extends CI_Model
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
    
    public function update_comment_details($post_id, $comment_id, $data)
    {
        $this->db->where('id', $comment_id);
        $this->db->where('post_id', $post_id);
        $this->db->update('post_comments' ,$data);
    }
}

?>