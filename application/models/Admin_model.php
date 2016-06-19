<?php

/**
 * @author 
 * @copyright 2014
 */
Class Admin_model extends CI_Model
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
    
    
    function check_user_by_number($mobile_number)
    {
        $this->db->select('*');
        $this->db->from('LOGIN_MASTER');
        $this->db->join('USER_MASTER_DETAILS', 'USER_MASTER_DETAILS.MOBILE_NO = LOGIN_MASTER.USER_ID', 'left');
        $this->db->where('LOGIN_MASTER.USER_ID', $mobile_number);
        $this->db->where('LOGIN_MASTER.ACTIVE', 'Y');
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

}

?>