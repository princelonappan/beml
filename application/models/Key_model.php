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

}
