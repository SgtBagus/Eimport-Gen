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
        $email_template = $this->mymodel->selectDataone('konfig', array('SLUG'=>'email-template'));

        $to_email = $user['email'];
        echo 'to_email : '; var_dump($to_email); echo'<br>';
        $from_email =  'admin@karyastudio.com';
        echo 'from_email : '; var_dump($from_email); echo'<br>';
        $subject = 'Verification Email !';
        echo 'subject : '; var_dump($subject); echo'<br>';


        $title = 'Coba : ';
        // echo $title; 
        // echo $email_template['value'];
        // echo eval('return '. $email_template['value'] . ';');

        // $body = $email_template['value'];

        // echo 'body : '; var_dump($body); echo'<br>';



        // mail($to_email, $subject, $body, $headers);


        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'procw57@gmail.com', // change it to yours
          'smtp_pass' => 'Andhikab57chan', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
      );

        $message = $email_template['value'];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('localhost@gmail.com'); // change it to yours
        $this->email->to('procw57@gmail.com');// change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message($message);
        if($this->email->send())
        {
            echo 'Email sent.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }   
}
