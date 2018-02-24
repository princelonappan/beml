<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->helper('form');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    function index()
    {
        if ($this->session->userdata('user'))
        {
            if($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role')
                    || $this->session->userdata('user')['admin_role'] == $this->config->item('user_admin_role')) {
                redirect($this->config->base_url().'user');
            } else {
                redirect($this->config->base_url().'post');
            }
        }
        else
        {
            $this->template->set_layout("outer_main");
            $this->template->build('/home/home_page');
        }
        
    }
    
    function verify_login()
    {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('item', array('message' => "Invalid username or password", 'class' => 'session_error'));
            //Field validation failed.  User redirected to login page
             $this->template->set_layout("outer_main");
            $this->template->build('/home/home_page');
        }
        else
        {
            //Go to private area
            redirect($this->config->base_url().'user');
        }
    }
    
    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $result = $this->User_model->login($username, $password);

        if ($result)
        {
            $sess_array = array();
            $admin_roles = $this->config->item('admin_roles');
            foreach ($result as $row)
            {
                if (in_array($row->is_admin_user, $admin_roles) &&
                        $row->is_admin_user == $this->config->item('is_admin_user') &&
                        $row->status == 1)
                {
                    $sess_array = array(
                        'user_id' => $row->id,
                        'username' => $row->email,
                        'is_admin_user' => $row->is_admin_user,
                        'admin_role' => $row->admin_role  
                    );
                    $this->session->set_userdata('user', $sess_array);
                }
                else
                {
                    $this->form_validation->set_message('check_database', 'Invalid username or password');
                    return false;
                }
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    function logout()
    {
        $this->session->unset_userdata('user');
        redirect($this->config->base_url().'home');
    }
    
    function forgot_password()
    {
//        $this->template->set_layout("outer_main");
        $this->template->build('/home/student_list');
    }
    
    function check_mobile_number($mobile_number)
    {
        //query the database
        $result = $this->user_details_model->check_user_by_number($mobile_number);

        if ($result)
        {
            return TRUE;
        }
        else
        {
            return false;
        }
    }

}

?>