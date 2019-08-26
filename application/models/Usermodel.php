<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model
{
	

	public function __construct()
	{
	
		$this->load->helper('date');
		$this->load->helper('string');
	}


	public function createuser()
	{

    $username = $this->input->post('username');
    $pass_word = $this->input->post('password');
    $hashed_password = $this->encrypt_password($pass_word);
    $userid = $this->genuid($username);
		$user = array(

			'userid' => $userid, 
			'username' => $username, 
			'email' => $this->input->post('email'),  
			'first_name' => $this->input->post('firstname'), 
			'last_name' => $this->input->post('lastname'), 
			'password' => $hashed_password, 
			
		);
		$query = $this->db->insert('users',$user);
		if ($query) {
       $email = $this->input->post('email');  
			$first_name = $this->input->post('firstname');
			$this->sendmail($email,$first_name);
		}
		
	}

	public function checkusername($username)
	{
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where('username',$username);
		$query = $this->db->get()->row();
		
		if ($query) {
			return $query;
		}
	}
	public function checkemail($email)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('email',$email);
		$query = $this->db->get()->row();
		
		if ($query) {
			return $query;
		}
	}

	public function log_out()
	{
		$data = array(
			'email', 
			'username', 
			'loggedin'
		);
		$this->session->unset_userdata($data);
		
	}

	public function genuid($username)
	{
	   $uid = substr($username, 0,3);
	   $uid = $uid.random_string('alnum',9);
	   return $uid;
	}

	public function signin()
	{
		
	}

	public function forgot_password()
	{
		$code = random_string('alnum',12);
		$email = $this->input->post('email');
		$data = array(
			'forgotten_password_code' => $code,
			'forgotten_password_time' => time(),
			 );
		$where = array(
			'email' => $email, 
		    );
		$save = $this->db->update('users',$data,$where);
		if ($save) {
		   $this->mailcode($email,$code);
		 }
	}
	public function mailcode($email,$fgcode)
	{
		$this->load->library('email');

	  //send forgotten password reset link
		$link = "<a href='/reset_password?rscd=".$fgcode."'>Reset</a>";

	    // $config['protocol'] = 'smtp';
	    // $config['smtp_host'] = 'smtp.gmail.com';
	    // $config['smtp_user'] = 'glasscupenterprise@gmail.com';
	    // $config['smtp_pass'] = 'shapiro7';
	    // $config['smtp_port'] = '25';
	    // $config['dsn'] = TRUE;
	    $config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
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

	public function mailwelcome($email,$firstname)
	{
		$this->load->library('email');

	  //send forgotten password reset link
		$link = "<a href='/reset_password?rscd=".$fgcode."'>Reset</a>";
		$data['email'] = $email;
		$data['firstname'] = $firstname;

	    // $config['protocol'] = 'smtp';
	    // $config['smtp_host'] = 'smtp.gmail.com';
	    // $config['smtp_user'] = 'glasscupenterprise@gmail.com';
	    // $config['smtp_pass'] = 'shapiro7';
	    // $config['smtp_port'] = '25';
	    // $config['dsn'] = TRUE;
	    $config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		

		$this->email->from('auth@glasscup.com', 'Glass Cup Ent');
		$this->email->to('ezekielarin@gmail.com');
		//$this->email->cc('another@another-example.com');
		$this->email->bcc('them@their-example.com');

		$this->email->subject('Reset Password');
		$this->email->message($this->load->view('email/welcome_ms',$data, TRUE));

		$q = $this->email->send();
		if ($q) {
			return TRUE;
		}
	}

	public function islogged()
	{
		return $this->session->userdata('username');
	}
	public function get_user()
	{
		$du = $this->islogged();
		$username = $du;

	   $this->db->select('*');	
	   $this->db->from('users');	
	   $this->db->where('username',$username);	
	   $query = $this->db->get()->row();
	   if ($query) {
	   		return $query;
	   	}	
	}

	public function logger()
	{
		$data = array(
			'userid' => '',
			'logintime' => '', 
			'ip_address' => '', 
			'browser' => '', 
			'os' => '',  
		    );
		$this->db->insert('login_log',$data);
	}

	public function change_password()
	{
		
	}

	public function text_verify()
	{
		
	}
	public function validate_phone()
	{
		
	}
	public function email_verify()
	{
	   	
	}
	
	public function encrypt_password($pass_word)
	{
		return md5($pass_word);
	}
}