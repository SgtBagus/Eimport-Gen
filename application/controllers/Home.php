<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = "home";

        $data['user'] = $this->mymodel->selectDataone('user', array('id' => $this->session->userdata('id')));

        if($this->session->userdata('role_id') == '17'){
            $this->template->load('template/template','template/index',$data);
        } else {
            $this->template->load('template/template_user','template/index',$data);
        }
    }
}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */