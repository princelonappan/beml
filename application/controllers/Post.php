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
        $data = array();
        $data['posts'] = $this->Post_model->get_posts();
        $this->template->build('/post/post_list', $data);
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
        $image = NULL;
        $data = array();
        if(isset($title) && !empty($body) 
                && isset($category) && !empty($media_type))
        {       
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0)
            {
                    $image = $this->_upload_image_beml($_FILES);
            }
            $data['title'] = $title;
            $data['body'] = $body;
            $data['category'] = $category;
            $data['media_type'] = $media_type;
            $data['media_url'] = $media_url;
            $data['image'] = $image;
            $this->Post_model->insert_post($data);
            $this->session->set_flashdata('message', 'This is my message');
            redirect('/post/create');
            
        }
    }
    
    private function _upload_image_beml($post)
    {
        $date = new DateTime();
        $config['upload_path'] = $this->config->item('upload_path');
        $config['allowed_types'] = $this->config->item('allowed_type');
        $config['max_size'] = $this->config->item('max_size');
        $config['max_width'] = $this->config->item('max_width');
        $config['max_height'] = $this->config->item('height');
        $config['remove_spaces'] = $this->config->item('remove_spaces');
        //$config['file_name'] = 'DC_' . $post['dc_id'] . '_' . str_replace('.', '_', $post['student_name']) . $date->getTimestamp();
        $img_file_name = $date->getTimestamp();
        $config['file_name'] = str_replace(' ', '_', $img_file_name);
        $config['ovewrite'] = $this->config->item('img_overite');

        //Uploads student image
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("image"))
        {
            $error = $this->upload->display_errors('', '');
            $this->session->set_flashdata('message', 'Post saved.');
        }
        else
        {
              $file_data = $this->upload->data();              
              return $file_data['file_name'];;
        }
    }
    
    public function post_view($id='')
    {
        $data['post'] = $this->Post_model->get_post_details($id);
        $this->template->build('/post/view_post', $data);
    }
}

?>