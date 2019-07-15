<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



abstract class MY_Controller extends CI_Controller{



	public function __construct() {

		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");

		$folder = $this->router->directory;

		$class = $this->router->class;

		$method = $this->router->method;

		$role = $this->session->userdata('role_id');

		

		if($folder==""){

			$link = $class."/".$method;

		}else{

			$link = $folder.$class."/".$method;

		}



		if($this->session->userdata('session_sop')==true){

		$get_link = $this->mymodel->selectDataone('access_control',array('val'=>$link));

		$cek = $this->mymodel->selectWhere('access',array('access_control_id'=>$get_link['id'],'role_id'=>$role));

		if($link!=""){

			if(count($cek)==0){

				// redirect('/');

			}	

		}

		}



		$this->konfig();



		// JIKA INGIN MENGAKTIFKAN LOG AKTIVITAS

		// $this->log_activity();





	}



	function konfig()

	{

		$konfig = $this->mymodel->selectData('konfig');

		foreach ($konfig as $knf) {

			define($knf['slug'], $knf['value']);

		}

	}



	public function upload_file($files)

	{

		# code...

				// cara memanggil

				// $hasil = $this->upload_file('file');

				// print_r($hasil);



				$dir  = "webfile/";

				$config['upload_path']          = $dir;

				$config['allowed_types']        = '*';

				$config['file_name']           = md5('smartsoftstudio').rand(1000,100000);

        		$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload($files)){

					$msg['response'] = false;

					$msg['message'] = $this->upload->display_errors();

						

				}else{

					$file = $this->upload->data();

					$data = array(

				   				'name'=> $file['file_name'],

				   				'mime'=> $file['file_type'],				   				

				   				'dir'=> $dir.$file['file_name'],

				   	 		);

					$msg['response'] = true;

					$msg['message'] = $data;

				}



				return $msg;



	}



	public function get_uri($folder="")

	{

		# code...

		if($folder!="api/"){

			$dir    =  dirname(__FILE__) .'/../controllers'.$folder;

			$files1 = scandir($dir);

			foreach ($files1 as $file) {

				$a = $file;

				if (strpos($a, '.php') !== false) {

				    $data['file'][] = $a;

				}else{

					if($a!="." AND $a!=".." AND strpos($a, '.') === false)

				    $data['folder'][] = $a;

				}

			}

			return $data;

		}

		

	}



	function log_activity()

	{

		$log['post'] = json_encode($this->input->post());

		$log['get'] = json_encode($this->input->get());

		$log['link'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$log['created_at'] = date('Y-m-d H:i:s');

		$log['user_id'] = $this->session->userdata('id');

		$log['ip'] = $this->input->ip_address();

		// print_r($log);

		$this->mymodel->insertData('activity',$log);

	}



	/*

	public function sendEmail()

    {

    	// $this->konfig();



       $this->load->library('email');



		$subject = 'This is a test';

		$message = '<p>This message has been sent for testing purposes.</p>';



		// Get full html:

		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>

		    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />

		    <title>' . html_escape($subject) . '</title>

		    <style type="text/css">

		        body {

		            font-family: Arial, Verdana, Helvetica, sans-serif;

		            font-size: 16px;

		        }

		    </style>

		</head>

		<body>

		' . $message . '

		</body>

		</html>';

		// Also, for getting full html you may use the following internal method:

		//$body = $this->email->full_html($subject, $message);



		$result = $this->email

		    ->from(EMAIL_FROM)

		    ->reply_to(EMAIL_REPLY_TO)    // Optional, an account where a human being reads.

		    ->to('bayubriyanelroy@gmail.com')

		    ->subject($subject)

		    ->message($body)

		    ->send();



		var_dump($result);

		echo '<br />';

		echo $this->email->print_debugger();



		exit;

    } */
	public function send_email($email, $nama, $title, $content, $link_html)
	{
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
        $this->email->send();
    }
}