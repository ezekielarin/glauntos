<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
 public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model(array('usermodel'));
	}

	
	public function index()
	{
		
     		$this->load->view('account/home');
	}

	public function products()
	{
		$this->load->view('products');
	}

	public function update_profile()
	{
		$this->load->view('profile_update');
	}

	public function change_password()
	{
		$this->load->view('change_password');
	}
	public function sendmail()
	{
		$this->load->library('email');

		//send forgotten password reset link
		$link = "<a href='/reset_password?rscd='fd'>Reset</a>";

	     $config['protocol'] = 'smtp';
	   //  $config['smtp_host'] = 'ssl://smtp.gmail.com';
	     $config['smtp_host'] = 'mail.glasscup.com.ng';
	     $config['smtp_user'] = 'info@glasscup.com.ng';
	     $config['smtp_pass'] = 'shapiro007';
	     $config['smtp_port'] = '465';
	     $config['dsn'] = TRUE;
	   // $config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		

		$this->email->from('auth@glasscup.com', 'Glass Cup Ent');
		$this->email->to('ezekielarin@gmail.com');
		//$this->email->cc('another@another-example.com');
		$this->email->bcc('them@their-example.com');

		$this->email->subject('Reset Password');
		$this->email->message('Follow the link to reset your password'.$link);

		$q = $this->email->send();
		if ($q) {
			return TRUE;
		}
	}

	


}
