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

    $body = '
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
    <td style="background:#f04386; -moz-border-radius: 40px; border-radius: 40px; font-family:Verdana, Arial; font-size:14px; font-weight:bold; text-transform:uppercase; color:#FFF;" data-bgcolor="theme-bg" mc:edit="tm4-06" valign="middle" height="60" align="center">
    <multiline>
    <a href="#" style="text-decoration:none; color:#FFF;">Konfirmasi Email</a>
    </multiline>
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
           'smtp_user' => 'muhammadsafreza@karyastudio.com', // change it to yours
           'smtp_pass' => 'loginloginlogin', // change it to yours
           'mailtype' => 'html',
           'charset' => 'iso-8859-1',
           'wordwrap' => TRUE
    );
    
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('muhammadsafreza@karyastudio.com','TOR EROKOMENDASI'); // change it to yours
    $this->email->to($user['email']);// change it to yours
    $this->email->subject('Varifikasi Email Anda !');
    $this->email->message('Ini Isinya COba');
    if($this->email->send()){
           echo "<script>alert('sukses dikirim');</script>";
    }else{
      show_error($this->email->print_debugger());
    }
  }
}