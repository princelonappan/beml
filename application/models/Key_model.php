<?php

class Key_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function update_key_details($key, $data)
    {
        $this->db->where('key', $key);
        $this->db->update('api_keys' ,$data);
    }
    
    public function get_device_token_details()
    {
        $this->db->select('*');
        $this->db->from('api_keys');
        $where = "device_token is NOT NULL";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

}
