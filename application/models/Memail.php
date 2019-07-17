<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memail extends CI_Model {

	public function send_email($email, $name, $title, $content, $link_html)
	{
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
		<multiline>Halo ! </multiline>
		<br>
		'.$name.'
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
		'.$link_html.'
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
        $this->email->to($email);// change it to yours
        $this->email->subject('Varifikasikan Email Anda !');
        $this->email->message($body);
        // if($this->email->send()){
        // 	return true;
  		// }else{
  		// 	$this->load->view('errors/html/error_500');
  		// }
    }

}