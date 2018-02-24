<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Front_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function index()
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') || 
                $this->session->userdata('user')['admin_role'] == $this->config->item('user_admin_role'))
        {
            $data['user_details'] = $this->User_model->get_all_users();
            $this->template->build('/user/user_list', $data);
        }
        else
        {
            $this->template->build('/errors/access_error'); 
        }
    }
    
    public function create()
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') || 
                $this->session->userdata('user')['admin_role'] == $this->config->item('user_admin_role'))
        {
            $this->template->build('/user/create_user'); 
        }
        else
        {
            $this->template->build('/errors/access_error'); 
        }
    }
    
    public function edit($id)
    {
        if ($this->session->userdata('user')['admin_role'] == $this->config->item('super_admin_role') || 
                $this->session->userdata('user')['admin_role'] == $this->config->item('user_admin_role'))
        {
            if(isset($id) && !empty($id)) 
            {
                $user_details = $this->User_model->get_user_by_id($id);
                if(isset($user_details) && !empty($user_details[0]))
                {
                    $data['user_details'] = $user_details[0];
                    $this->template->build('/user/edit_user', $data); 
                }
                else
                    redirect('/user');
            }
            else
            {
                redirect('/user');
            } 
        }
        else
        {
            $this->template->build('/errors/access_error'); 
        }
    }
    
    public function update_details() 
    {
        print_r($_POST);
        $user_id = $this->input->post('user_id');
        $can_post_manage = $this->input->post('can_post_manage');
        $status = $this->input->post('status');
        $is_admin_user = $this->input->post('is_admin_user');
        $admin_role = $this->input->post('admin_role');
        if(isset($user_id) && !empty($user_id)) 
        {
            $update_data['is_comment_share_post'] = $can_post_manage;
            $update_data['status'] = $status;
            if($is_admin_user == $this->config->item('is_admin_user'))
            {
                $update_data['is_admin_user'] = $is_admin_user;
                $update_data['admin_role'] = $admin_role;
            }
            else
            {
                $update_data['is_admin_user'] = 0;
                $update_data['admin_role'] = 0;
            }
            
            $this->User_model->update_users_details($user_id, $update_data);
            $this->session->set_flashdata('message', 'User Details Updated');
            redirect('/user');
        }

    }
    public function save_details()
    {
        $employee_id = $_POST['employee_id'];
        $dob = $_POST['dob'];
        $doj = $_POST['doj'];
        if(!empty($employee_id) && !empty($dob) && !empty($doj))
        {
            $date_of_birth = date("Y-m-d", strtotime($dob));
            $date_of_join = date("Y-m-d", strtotime($doj));
            $user_details = $this->User_model->get_user_by_employee_id($employee_id);
            if (empty($user_details))
            {
                $user_details['employee_id'] = $employee_id;
                $user_details['date_of_birth'] = $date_of_birth;
                $user_details['date_of_join'] = $date_of_join;
                $user_details['created_date'] = $user_details['modified_date'] = get_current_datetime();
                $user_details['is_comment_share_post'] = $_POST['can_post_manage'];
                if($_POST['is_admin_user'] == $this->config->item('is_admin_user')) 
                {
                    $user_details['is_admin_user'] = $_POST['is_admin_user'];
                    $user_details['admin_role'] = $_POST['admin_role'];
                    $user_details['password'] = md5($_POST['password']);
                }
                else
                {
                    $user_details['is_admin_user'] = $_POST['is_admin_user'];
                    $user_details['admin_role'] = 0;
                }
                
                $this->User_model->save_user_details($user_details);
                $this->session->set_flashdata('message', 'Created the user details.');
                redirect("/user/create");
            }
            else
            {
                $this->session->set_flashdata('message', 'Already employee id is taken.');
                redirect("/user/create");
            }
        }
        else
        {
            redirect("/user");
        }
    }


    public function change_status($id, $status)
    {
        if (isset($id) && !empty($id))
        {
            $user_details = array(
                'status' => $status);

            $user_details = $this->User_model->update_users_details($id, $user_details);
            redirect("/user");
        }
        else
        {
            redirect("/user");
        }
    }
}

?>