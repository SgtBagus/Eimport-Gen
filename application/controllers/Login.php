<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Memail');
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
		redirect('/');
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
                $this->alert->alertdanger('Mohon cek ulang Email dan Passowrd Anda !');
                return FALSE;

            }
    }
    
    public function password()
    { 
        $this->load->view('login/password');
    }

    public function emailpassword(){
        $email = $this->input->post('email');
        $cek_email = $this->mymodel->selectWhere('user', array('email' => $email));
        if($cek_email){

            $link = base_url('login/changepassword/').md5($cek_email[0]['email']);

            $this->Memail->send_email(
              $cek_email[0]['email'], 
              $cek_email[0]['name'], 
              'Merubah Password !', 
              'Perubahan password bisa di lakukan dengan mengklik tombol di bawah ini !', 
              '<a href="'.$link.'" style="text-decoration:none; color:#FFF;" target="_blank">
              <button style="color:#FFF; background-color: #007aff; border:0px; border-radius: 100px; height:60px; width:200px; font-family:Verdana, Arial; font-size:20px; font-weight:bold;" align="center">
              Ganti Password
              </button>
              </a>'
          );
        
            $this->alert->alertsuccess('Mohon mengencek inbox email anda !');

        }else{
            $this->alert->alertdanger('Email Tidak Terdaftar');
        }
    }

    public function changepassword($email){

        $cek_user = $this->mymodel->selectWithQuery('SELECT * FROM user WHERE md5(email) = "'.$email.'"');

        if($cek_user){
            $data['id'] = $cek_user[0]['id'];
            $this->load->view('login/change-pass', $data);
        }else{
            $this->load->view('errors/html/error_404');
        }
    }

    public function act_password($id){

        $password = $this->input->post('password');
        $new_password = $this->input->post('new_password');

        if(!$password){
            $this->alert->alertdanger('Password Tidak Boleh Kosong !');   
        }else if ($password != $new_password){
            $this->alert->alertdanger('Konfirmasi Passowrd harus sama !');   
        }else {    
            $dataup['password'] = md5($password);
            $dataup['updated_at'] = date("Y-m-d H:i:s");
            $this->mymodel->updateData('user', $dataup , array('id'=> $id));
            $this->alert->alertsuccess('Berhasil mengubah Password');   
        }
    }


    // function lockscreen(){
    //     $this->load->view('login/lockscreen');
    // }

}
