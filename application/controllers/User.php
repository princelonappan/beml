<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Front_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->template->build('/user/user_list');
    }
}

?>