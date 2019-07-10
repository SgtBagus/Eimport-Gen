<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
        $title = 'Verification Email Anda !';
        $body = $email_template;

        echo 'body : '; var_dump($body); echo'<br>';



        // mail($to_email, $subject, $body, $headers);


    }

}
