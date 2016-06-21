<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Office extends REST_Controller
{

    function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('Offices_model');
    }
    
    public function get_offices_get()
    {
        $offices = $this->Offices_model->get_offices();
        if($offices && !empty($offices))
        {
             $this->response(array('result_code' => 200, 'result_title' => 'Success',
                    'categories' => $offices));
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No offcies found.'));
        }
    }
}