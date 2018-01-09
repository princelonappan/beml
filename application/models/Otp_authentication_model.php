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
        $this->db->set($otp_details);
        return $this->db->insert('otp_authentication', $otp_details); 
    }
    
    public function delete_previous_otp_entries($mobile_number, $type)
    {
        try
        {
            $this->db->where('mobile_number', $mobile_number);
            $this->db->where('type', $type);
            $this->db->where('is_verified', 0);
            $this->db->delete('otp_authentication');
            return true;
            
        } catch (Exception $exc)
        {
            return false;
        }
    }
}
