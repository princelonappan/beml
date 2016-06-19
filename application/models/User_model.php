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
    
    public function get_user_by_employee_details($employee_id, $date_of_birth, $date_of_join)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('employee_id =', $employee_id);
        $this->db->where('date_of_birth =', $date_of_birth);
        $this->db->where('date_of_join =', $date_of_join);
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

}

?>