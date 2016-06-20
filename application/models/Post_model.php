<?php

/**
 * @author 
 * @copyright 2014
 */
Class Post_model extends CI_Model
{
    
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
}

?>