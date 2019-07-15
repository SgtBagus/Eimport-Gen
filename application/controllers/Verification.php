<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Verification extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

  function user($id) 
  {
    $user = $this->mymodel->selectDataone('user', array('id'=>$id));
    $link = base_url('verification/update/').$id.'/'.md5($user['name']);

    $this->send_email(
      $user['email'], 
      $user['name'], 
      'Selamat Datang !', 
      'Mohon Lakukan varifikasi email dengan cara menekan tombol dibawah ini !', 
      '<a href="'.$link.'" style="text-decoration:none; color:#FFF;" target="_blank">
        <button style="color:#FFF; background-color: #007aff; border:0px; border-radius: 100px; height:60px; width:200px; font-family:Verdana, Arial; font-size:20px; font-weight:bold;" align="center">
          Verifikasikan Email
        </button>
      </a>'
    );

    redirect(base_url("?verification=1"));
  }

  public function update($id, $name){
    $user = $this->mymodel->selectDataone('user', array('id'=>$id));
    if($user){
      if($name == md5($user['name'])){
        $data['verification'] = 'TRUE';
        $this->mymodel->updateData('user', $data , array('id'=>$id));
        redirect(base_url());
      }else{
        redirect(base_url("?verification=0"));
      }
    }else{
      redirect(base_url("?verification=0"));
    }
  }
}