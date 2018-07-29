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
        $this->load->model('Post_comments_model');
        $this->load->model('Post_model');
    }

    public function index()
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') ||
                $this->session->userdata('user')['admin_role'] == $this->config->item('post_admin_role'))
        {
            $data = array();
            $data['posts'] = $this->Post_model->get_posts();
            $this->template->build('/post/post_list', $data);
        }
        else 
        {
            $this->template->build('/errors/access_error');
        }
    }
    
    public function create()
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') ||
                $this->session->userdata('user')['admin_role'] == $this->config->item('post_admin_role'))
        {
            $catgories = $this->Post_category_model->get_categories();
            $data['categories'] = $catgories;
            $this->template->build('/post/create_post', $data);
        }
        else 
        {
            $this->template->build('/errors/access_error');
        }
    }
    
    public function save_details()
    {
 
        $title = $this->input->post('title');
        $body = $this->input->post('body');
        $category = $this->input->post('category');
        $media_type = $this->input->post('media_type');
        $media_url = $this->input->post('media_url');
        $can_share = $this->input->post('can_share');
        $media_available = $this->input->post('media_available');
        $image = NULL;
        $data = array();
        if (isset($title) && !empty($body) && isset($category) && !empty($media_available))
        {

            if ($media_available == 1)
            {
                //Checking the image
                if ($media_type == 6)
                {
                    $allowed = $this->config->item('image_extensions');
                    $maz_size = $this->config->item('image_size_in_mb') * 1048576;
                    $filename = $_FILES['image']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!in_array($ext, $allowed))
                    {
                        $this->session->set_flashdata('message', 'Invalid Image Extension.');
                        redirect('/post/create');
                    }
                    else if ($_FILES['image']['size'] >= $maz_size)
                    {
                        $this->session->set_flashdata('message', 'File too large.');
                        redirect('/post/create');
                    }

                    $image = $this->_upload_image_beml($_FILES, 6);
                }
                else if ($media_type == 7)
                {                   
                    $allowed = $this->config->item('video_extensions');
                    $maz_size = $this->config->item('video_size_in_mb') * 1048576;
                    $filename = $_FILES['video']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!in_array($ext, $allowed))
                    {
                        $this->session->set_flashdata('message', 'Invalid Video Extension.');
                        redirect('/post/create');
                    }
                    else if ($_FILES['video']['size'] >= $maz_size)
                    {
                        $this->session->set_flashdata('message', 'File too large.');
                        redirect('/post/create');
                    }

                    $image = $this->_upload_image_beml($_FILES, 7);
                }
            } 
            else
            {
                $media_type = 0;
                $media_url = NULL;
            }


            $data['title'] = $title;
            $data['body'] = $body;
            $data['category'] = $category;
            $data['media_type'] = $media_type;
            $data['media_url'] = $media_url;
            $data['media_available'] = $media_available;
            $data['image'] = $image;
            $data['is_share'] = $can_share;
            $data['user_id'] = get_logged_user_id();
            $this->Post_model->insert_post($data);
            $this->session->set_flashdata('message', 'Post saved');
            redirect('/post/create');
            
        } 
        else
        {
            $this->session->set_flashdata('message', 'Failed to save the information. Please check you have provided valid data');
            redirect('/post/create');
        }
    }
    
    private function _upload_image_beml($post, $type)
    {
        $date = new DateTime();
        $config['upload_path'] = $this->config->item('upload_path');
        if($type == 6)
        {
            $config['max_size'] = $this->config->item('image_size_in_mb') * 1048;
            $config['allowed_types'] = $this->config->item('image_extensions_libaray_format');
            $type_name = 'image';
        }
        else
        {
            $config['max_size'] = $this->config->item('video_size_in_mb') * 1048;
            $config['allowed_types'] = $this->config->item('video_extensions_libaray_format');
            $type_name = 'video';
        }
                 
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
        if (!$this->upload->do_upload($type_name))
        {
            $error = $this->upload->display_errors('', '');
            $this->session->set_flashdata('message', 'Error Occured while saving the post.');
        }
        else
        {
              $file_data = $this->upload->data();              
              return $file_data['file_name'];
        }
    }
    
    public function post_view($id='')
    {
        $data['post'] = $this->Post_model->get_post_details($id);
        $this->template->build('/post/view_post', $data);
    }
    
    public function delete($id)
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') ||
                $this->session->userdata('user')['admin_role'] == $this->config->item('post_admin_role'))
        {
            if (isset($id) && !empty($id))
            {
                $this->Post_model->delete_post($id);
                redirect('/post');
            }
            else
            {
                redirect('/post');
            }
        }
        else 
        {
            $this->template->build('/errors/access_error');
        }
        
    }
    
    public function edit($id)
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') ||
                $this->session->userdata('user')['admin_role'] == $this->config->item('post_admin_role'))
        {
            if(isset($id) && !empty($id)) 
            {
                $catgories = $this->Post_category_model->get_categories();
                $data['categories'] = $catgories;
                $data['post'] = $this->Post_model->get_post_details($id);
                $this->template->build('/post/edit_post', $data);
            }
            else
            {
                redirect('/post');
            }
        }
        else 
        {
            $this->template->build('/errors/access_error');
        }
       
    }
    
    public function edit_details()
    {
        $post_id = $this->input->post('post_id');
        $title = $this->input->post('title');
        $body = $this->input->post('body');
        $category = $this->input->post('category');
        $media_type = $this->input->post('media_type');
        $media_url = $this->input->post('media_url');
        $can_share = $this->input->post('can_share');
        $media_available = $this->input->post('media_available');
        $image = NULL;
        $data = array();

        if (isset($title) && !empty($body) && isset($category) && !empty($media_available))
        {
            if ($media_available == 1)
            {
                //Checking the image
                if ($media_type == 6)
                {
                    $allowed = $this->config->item('image_extensions');
                    $maz_size = $this->config->item('image_size_in_mb') * 1048576;
                    $filename = $_FILES['image']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!in_array($ext, $allowed))
                    {
                        $this->session->set_flashdata('message', 'Invalid Image Extension.');
                        redirect('/post/create');
                    }
                    else if ($_FILES['image']['size'] >= $maz_size)
                    {
                        $this->session->set_flashdata('message', 'File too large.');
                        redirect('/post/create');
                    }

                    $image = $this->_upload_image_beml($_FILES, 6);
                }
                else if ($media_type == 7)
                {
                    $allowed = $this->config->item('video_extensions');
                    $maz_size = $this->config->item('video_size_in_mb') * 1048576;
                    $filename = $_FILES['video']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!in_array($ext, $allowed))
                    {
                        $this->session->set_flashdata('message', 'Invalid Video Extension.');
                        redirect('/post/create');
                    }
                    else if ($_FILES['image']['size'] >= $maz_size)
                    {
                        $this->session->set_flashdata('message', 'File too large.');
                        redirect('/post/create');
                    }

                    $image = $this->_upload_image_beml($_FILES, 7);
                }
                
                if($media_type && $media_url) 
                {
                    $data['media_type'] = $media_type;
                    $data['media_url'] = $media_url;
                }
                    
                if ($image)
                    $data['file_path'] = $image;
                
            } else
            {
                    $data['media_type'] = 0;
                    $data['media_url'] = NULL;
                    $data['file_path'] = NULL;
            }

            $data['title'] = $title;
            $data['body'] = $body;
            $data['category_id'] = $category;
            $data['media_available'] = $media_available;
            
            $data['is_share'] = $can_share;
            $data['modified_date'] = get_current_datetime();
            $this->Post_model->update_post_details($post_id, $data);
            $this->session->set_flashdata('message', 'Post Updated');
            redirect('/post/edit/'.$post_id);
            
        }
        else
        {
            $this->session->set_flashdata('message', 'Failed to update the information. Please check you have provided valid data');
            redirect('/post');
        }
    }
    
    public function view_comments($id)
    {
        if(isset($id) && !empty($id)) 
        {
            $data['post'] = $this->Post_model->get_post_details($id);
            $data['comments'] = $this->Post_comments_model->get_all_post_comments($id);
            $this->template->build('/post/post_comment_list', $data);
        }
        else
        {
            redirect('/post');
        }
    }
    
    public function change_comment_status($id, $status, $post_id)
    {
        if(isset($id) && !empty($id) && $status) 
        {
            $update_data['status'] = $status;
            $this->Post_comments_model->updated_post_comment($id, $update_data);
            redirect("post/view_comments/".$post_id);
        }
        else
        {
            redirect('/post');
        }
    }
}

?>