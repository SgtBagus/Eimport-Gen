<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{ 
        if(LOGIN==0){
		  $this->load->view('login/login');
        }else{
          $this->load->view('login/login-1'); 
        }
	}

	public function logout()
	{
		# code...
        $this->session->sess_destroy();
		redirect('login');
	}


	   public function act_login()
    {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            // $acak = "!@#$%^&*()_+SMARTSOFT+_()*&^%$#@!";
             $pass = md5($password);

            $cek     = $this->mlogin->login($email,$pass);
            $session = $this->mlogin->data($email);
            if ($cek > 0) {
                $this->session->set_userdata('session_sop', true);
                $this->session->set_userdata('id', $session->id);
                $this->session->set_userdata('nip', $session->nip);
                
                $this->session->set_userdata('role_id', $session->role_id);
                $this->session->set_userdata('name', $session->name);


                echo "oke";
                return TRUE;
            } else {
                $this->alert->alertdanger('Check again your NIP and password');
                return FALSE;

            }
    }
    //     function lockscreen()
    // {
    //     $this->load->view('login/lockscreen');
    // }

}
