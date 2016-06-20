<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends Front_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Post_category_model');
        $this->load->model('Post_model');
    }

    public function index()
    {
        $this->template->build('/post/post_list');
    }
    
    public function create()
    {
        $catgories = $this->Post_category_model->get_categories();
        $data['categories'] = $catgories;
        $this->template->build('/post/create_post', $data);
    }
    
    public function save_details()
    {
        $title = $this->input->post('title');
        $body = $this->input->post('body');
        $category = $this->input->post('category');
        $media_type = $this->input->post('media_type');
        $media_url = $this->input->post('media_url');
        $can_share = $this->input->post('can_share');
        if(isset($title) && !empty($body) 
                && isset($category) && !empty($media_type) && !empty($media_url))
        {
            
        }
    }
}

?>