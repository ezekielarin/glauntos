<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model(array('usermodel'));
		$this->load->helper('cookie');
	}

	public function index()
	{
		if (!$this->usermodel->islogged()) {
			redirect('auth/login');
		}else{
			$data['user'] = $this->usermodel->get_user();
		}
		$this->load->view('welcome',$data);
	}
}
