<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_queue extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');

	}

	public function index()
	{
		show_404();
	}

	public function send_queue()
	{
		$this->email->send_queue();
	}

	public function retry_queue()
	{
		$this->email->retry_queue();
	}
}
