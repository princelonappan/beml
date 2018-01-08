<?php

/**
 * @author 
 * @copyright 2014
 */
Class Otp_authentication_model extends CI_Model
{

    function get_otp_details($mobile_number, $otp)
    {
        $this->db->select('*');
        $this->db->from('otp_authentication');
        $this->db->where('mobile_number =', $mobile_number);
        $this->db->where('otp =', $otp);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function save_otp($otp_details)
    {
        return $this->db->insert('otp_authentication', $otp_details); 
    }
}
