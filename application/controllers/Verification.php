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
    $konfig = $this->mymodel->selectDataone('konfig', array('SLUG'=>'COPYRIGHT'));
    $link = base_url('verification/update/').$id.'/'.md5($user['name']);

    $body = '
    <style>
    .myButton {
      background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #277d9c), color-stop(1, #408c99));
      background:-moz-linear-gradient(top, #277d9c 5%, #408c99 100%);
      background:-webkit-linear-gradient(top, #277d9c 5%, #408c99 100%);
      background:-o-linear-gradient(top, #277d9c 5%, #408c99 100%);
      background:-ms-linear-gradient(top, #277d9c 5%, #408c99 100%);
      background:linear-gradient(to bottom, #277d9c 5%, #408c99 100%);
      filter:progid:DXImageTransform.Microsoft.gradient(
      startColorstr="#277d9c", 
      endColorstr="#408c99",GradientType=0);
      background-color:#277d9c;
      -moz-border-radius:42px;
      -webkit-border-radius:42px;
      border-radius:42px;
      display:inline-block;
      cursor:pointer;
      color:#ffffff;
      font-family:Arial;
      font-size:20px;
      font-weight:bold;
      padding:19px 35px;
      text-decoration:none;
    }
    .myButton:hover {
      background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #277d9c));
      background:-moz-linear-gradient(top, #408c99 5%, #277d9c 100%);
      background:-webkit-linear-gradient(top, #408c99 5%, #277d9c 100%);
      background:-o-linear-gradient(top, #408c99 5%, #277d9c 100%);
      background:-ms-linear-gradient(top, #408c99 5%, #277d9c 100%);
      background:linear-gradient(to bottom, #408c99 5%, #277d9c 100%);
      filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#408c99", endColorstr="#277d9c",GradientType=0);
      background-color:#408c99;
    }
    .myButton:active {
      position:relative;
      top:1px;
    }


    </style>
    <table class="two-left-inner" width="500" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
    <tr>
    <td style="background:#FFF;" class="editable" valign="top" contenteditable="false" align="center">
    <table width="295" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
    <tr>
    <td style="font-size:55px; line-height:55px;" valign="top" height="55" align="center">&nbsp;</td>
    </tr>
    <tr>
    <td style="font-size:40px; line-height:40px;" valign="top" height="40" align="center">&nbsp;</td>
    </tr>
    <tr>
    <td style="font-family:sans-serif, Verdana; font-size:22px; color:#4b4b4c; line-height:30px; font-weight:normal;" mc:edit="tm4-03" valign="top" align="center">
    <multiline>Hello! </multiline>
    <br>
    '.$user['name'].'
    </td>
    </tr>
    <tr> 
    <td valign="top" align="center">&nbsp;</td>
    </tr>
    <tr>
    <td style="font-family:sans-serif, Verdana; font-size:48px; color:#4b4b4c; line-height:50px; font-weight:bold;" mc:edit="tm4-04" valign="top" align="center">
    <multiline>Selamat Datang !</multiline>
    </td>
    </tr>
    <tr>
    <td valign="top" align="center">&nbsp;</td>
    </tr>
    <tr>
    <td style="font-family:sans-serif, Verdana; font-size:13px; color:#71746f; line-height:22px; font-weight:normal;" mc:edit="tm4-05" valign="top" align="center">
    <multiline>Mohon lakukan varifikasi email anda dengan mengklik button dibawah ini !</multiline>
    </td>
    </tr>
    <tr>
    <td valign="top" align="center">
    <table width="180" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
    <tr>
    <td valign="top" height="30" align="center">&nbsp;</td>
    </tr>
    <tr>
    <td>
    <a href="'.$link.'" style="text-decoration:none; color:#FFF;" target="_blank">
    <button style="color:#FFF; background-color: #007aff; border:0px; border-radius: 100px; height:60px; width:200px; font-family:Verdana, Arial; font-size:20px; font-weight:bold;" align="center">Verifikasikan Email
    </button>
    </a>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td style="font-size:30px; line-height:30px;" valign="top" height="30" align="center">&nbsp;</td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
    <tr>
    <td valign="top" align="center">
    <table class="two-left-inner" width="500" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
    <tr>
    <td valign="top" align="center">
    <table width="260" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
    <tr>
    <td style="font-size:40px; line-height:40px;" valign="top" height="40" align="center">&nbsp;</td>
    </tr>
    <tr>
    <td style="font-family:sans-serif, Verdana; font-size:12px; color:#4b4b4c; line-height:30px; font-weight:normal;" mc:edit="tm4-11" valign="top" align="center">
    <multiline>'.$konfig['value'].'</multiline>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>';

    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://mail.karyastudio.com',
      'smtp_port' => 465,
           'smtp_user' => 'bagus@karyastudio.com', // change it to yours
           'smtp_pass' => 'bagus123bagus', // change it to yours
           'mailtype' => 'html',
           'charset' => 'iso-8859-1',
           'wordwrap' => TRUE
         );
    
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('bagus@karyastudio.com','TOR E-REKOMENDASI'); // change it to yours
    $this->email->to($user['email']);// change it to yours
    $this->email->subject('Varifikasikan Email Anda !');
    $this->email->message($body);
    $this->email->send();
    
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