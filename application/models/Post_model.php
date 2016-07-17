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
    
    /**
     * $data['title'] = $title;
            $data['body'] = $body;
            $data['category'] = $category;
            $data['media_type'] = $media_type;
            $data['media_url'] = $media_url;
            $data['image'] = $image;
     * @param type $data
     */
    public function insert_post($data)
    {
        if(isset($data) && $data != NULL && $data != '')
        {
            $date_user = new DateTime();
            $date = $date_user->format("Y-m-d");
            $new_data = array(
                 'title' => $data['title'],   
                 'body' => $data['body'],   
                 'category_id' => $data['category'],   
                 'media_type' => $data['media_type'],   
                 'file_path' => $data['image'],   
                 'media_url' => $data['media_url'],
                 'is_share' => $data['is_share'],
                 'created_date' => $date,   
                 'modified_date' => $date
            );
            $this->db->insert('post', $new_data);
        }
    }
    
    public function get_posts()
    {
        $this->db->select('*,a.id as cat_id, post.id as post_id, post.created_date as post_created_date');
        $this->db->from('post');
        $this->db->join('post_category as a','post.category_id = a.id');
        $this->db->order_by("post.created_date", "desc"); 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_post_details($id)
    {
        $this->db->select('*,a.id as cat_id, post.id as post_id');
        $this->db->from('post');
        $this->db->join('post_category as a','post.category_id = a.id');
        $this->db->where('post.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_post_by_category($category_id, $pagination_limit, $offset)
    {
        $limit = $pagination_limit * $offset;
        $this->db->select('*, a.id as cat_id, post.id as post_id, a.category_name as category_name, post.created_date as post_created_date');
        $this->db->from('post');
        $this->db->join('post_category as a','post.category_id = a.id');
        $this->db->where('post.category_id', $category_id);
        $this->db->order_by("post.created_date", "desc"); 
        $this->db->limit($pagination_limit, $limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function update_post_details($post_id, $data)
    {
        $this->db->where('id', $post_id);
        $this->db->update('post' ,$data);
    }
    
    public function delete_post($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('post'); 
    }
}

?>
