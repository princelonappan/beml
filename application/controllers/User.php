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
        $data['user_details'] = $this->User_model->get_all_users();
        $this->template->build('/user/user_list', $data);
    }
    
    public function create()
    {
       $this->template->build('/user/create_user'); 
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