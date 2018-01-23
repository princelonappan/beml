<?php

/**
 * @author 
 * @copyright 2014
 */
Class User_model extends CI_Model
{

    function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    
    public function get_user_by_employee_details($employee_id, $date_of_birth, $date_of_join, $mobile_number = NULL)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('employee_id =', $employee_id);
        $this->db->where('date_of_birth =', $date_of_birth);
        $this->db->where('date_of_join =', $date_of_join);
        if($mobile_number)
        {
            $this->db->where('mobile_number =', $mobile_number);
        }     
        $this->db->where('status =', 1);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_user_by_employee_id($employee_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('employee_id =', $employee_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_user_by_mobile_id($mobile_number)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('mobile_number =', $mobile_number);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function update_users_details($user_id, $data)
    {
        $this->db->where('id', $user_id);
        $this->db->update('users' ,$data);
    }
    
    public function get_user_by_id($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id =', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_all_users() 
    {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function save_user_details($user_details)
    {
        return $this->db->insert('users', $user_details); 
    }
    
    public function get_user_by_token($reset_password_token)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('reset_password_token =', $reset_password_token);
        $query = $this->db->get();
        return $query->result();
    }

}

?>