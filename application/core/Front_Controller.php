<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Front_Controller
 *
 * This controller is used for user actions of a logged in user
 *
 * @package    Recharge
 * @subpackage    Controller
 * @category    Controller
 * @author    Manu Jose K
 * @date    03-05-2015
 *
 */

/**
 * MY_Controller
 *
 * This controller is used access a common entry point for logged on & non logged in user
 *
 * @package	Recharge
 * @subpackage	Controller
 * @category	Controller
 * @author	Manu Jose K
 * @date	03-05-2015
 * 
 */
class Front_Controller extends MY_Controller
{

     public function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('user'))
        {
            redirect('/home');
        }

    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */