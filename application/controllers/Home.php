<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller
{

    function __construct()
    {

        parent::__construct();
        $this->load->helper('form');
        $this->load->model('admin_model');
        $this->load->library('session');
    }

    function index()
    {
        if ($this->session->userdata('user'))
        {
            redirect($this->config->base_url().'user');
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
        $result = $this->admin_model->login($username, $password);

        if ($result)
        {
            $sess_array = array();
            foreach ($result as $row)
            {
                $sess_array = array(
                    'user_id' => $row->id,
                    'username' => $row->email
                );
                $this->session->set_userdata('user', $sess_array);
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