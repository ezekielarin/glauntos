<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
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
		}
		//$this->cookie->
		set_cookie('$name', '$domain', '$path', '$prefix');
		$this->load->view('home');
	}

	public function login()
	{
		if ($this->usermodel->islogged()) {
			redirect('welcome');
		}
		if (isset($_POST['login'])) {
			$username = $this->input->post('username');
			$pass = $this->input->post('password');
			$password = $this->usermodel->encrypt_password($pass);

             $userdata = $this->checkuser($username,$password);
			if ($userdata) {
				    $data = array(
				    	'username' => $userdata->username, 
				    	'email' => $userdata->email, 
				    	'loggedin' => true, 
				    );
				    $this->session->set_userdata($data);
                   
                   #redirect back to source url
                    if (isset($_GET['redir_url'])) {
                    	#redirect back to web app requesting login
                    	redirect($_GET['redir_url']);
                    }else{
                    	redirect('welcome');
                    }
				    
		     }else{
		     	echo "wrong login details";
		     }
		   

		}
		$ses = $this->session->userdata();
		$this->load->view('login');
	}

	public function register()
	{
		if ($this->usermodel->islogged()) {
			redirect('auth');
		}
		if (isset($_POST['register'])) {

			//start validation and save user
		  	$this->usermodel->createuser();
		}
		$data['username_error'] = '';
		$this->load->view('register',$data);
	}

	public function logout()
	{
		$data = array(
			'email', 
			'username', 
			'loggedin'
		);
		$this->session->unset_userdata($data);
		
		redirect('/auth/login');
		    
	}

	public function checkuser($username,$password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get()->row();
		if ($query) {
			return $query;
		}
	}
	public function forgot_password()
	{
		$data['message']= "";
		$email = $this->input->post('email');
		if (isset($_POST['email'])) {
			$check = $this->usermodel->checkemail($email);
			if ($check) {
				//$data['message']= "Check your email for reset instruction";
				$get = $this->usermodel->forgot_password($email);
			//	$data['message'] = $get;
			//	$data['message'] = $get;
				if ($get) {
					$data['message'] = 'success';
				}
			}
			
		}else{
			$data['message']= "No account with such email is found";
		}
		$this->load->view('forgot_password',$data);

	}

	public function reset_password()
	{
		if (isset($_GET['rscd'])) {
			$rcode = $_GET['rscd'];
			$check = $this->db->query("SELECT email,userid,forgotten_password_code FROM users WHERE forgotten_password_code='$rcode'")->row();

			if ($check) {

				$data['user'] = $check;
				$this->load->view('reset_password',$data);
			}
		}
		

	}
	public function change_password()
	{
		if (!$this->usermodel->islogged()) {
			redirect('auth/login');
		}
		$data['message'] = "";
		if (isset($_POST['changepass'])) {
			$pass_word = $this->input->post('password');
			$pass_word2 = $this->input->post('retype_password');

			if ($pass_word==$pass_word2) {
				
					$password = $this->usermodel->encrypt_password($pass_word);
					$username = $this->input->post('username');
					$data = array(
						'password' => $password, 
					     );
					$where = array('username' => $username, );
				    $query = $this->db->update('users',$data,$where);
				    if ($query) {
				    	$data['message'] =  "successfully changed password";
				    }
				  }else{
				  	$data['message'] = "password do not match";
				  }
		}
		$data['user'] = $this->usermodel->get_user();
      $this->load->view('change_password',$data);
	}

	public function edit_profile()
	{
		if (!$this->usermodel->islogged()) {
			redirect('auth/login');
		}
		if (isset($_POST['update'])) {
			$data = array(
				'first_name' => $this->input->post('first_name'), 
				'last_name' => $this->input->post('last_name'), 
				'phone' => $this->input->post('phone'), 
			);
			$where = array('username' => $this->input->post('username'), );
			$query = $this->db->update('users',$data,$where);
			if ($query) {
				echo "success";
			}
		}

		$data['user'] = $this->usermodel->get_user();
		$this->load->view('edit_profile',$data);

	}
}
