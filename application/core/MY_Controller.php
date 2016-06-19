<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
class MY_Controller extends CI_Controller
{

    protected $data;
    public $module;
    public $controller;
    public $method;
    public $module_details;
    public $user;

    public function __construct()
    {
        parent::__construct();

        if ($this->config->item('debug_profiler'))
        {
            $this->output->enable_profiler(TRUE);
        }

        $this->_clear_cache();

        $this->benchmark->mark('my_controller_start');
        $this->load->library('session');
        $this->load->library('template');
        $this->load->helper('url');

        // Is there a layout file for this module?
        if ($this->template->layout_exists($this->module . '.html'))
        {
            $this->template->set_layout($this->module . '.html');
        }
        // Nope, just use the default layout
        else
        {
            $this->template->set_layout('main.php');
        }

        //$this->benchmark->mark('my_controller_end');
    }

    /**
     * Set header response to avoide browsing caches
     *  
     */
    protected final function _clear_cache()
    {
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }



}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */