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


		if($this->session->userdata('role_id') == '24'){
			$data['pengajuan_row'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE user_id = '".$this->session->userdata('id')."'");
			$data['pengajuan_process'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE approve LIKE 'PROCESS%' AND user_id = '".$this->session->userdata('id')."'");
			$data['pengajuan_approve'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE approve = 'ACCEPT' AND user_id = '".$this->session->userdata('id')."'");
			$data['pengajuan_reject'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE approve = 'REJECT' AND user_id = '".$this->session->userdata('id')."'");

			$data['pengajuans'] = $this->mymodel->selectWithQuery("SELECT * FROM pengajuan WHERE user_id = '".$this->session->userdata('id')."' LIMIT 10 ");
		}else{
			$data['pengajuan_row'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan");
			$data['pengajuan_process'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE approve LIKE 'PROCESS%'");
			$data['pengajuan_approve'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE approve = 'ACCEPT '");
			$data['pengajuan_reject'] = $this->mymodel->selectWithQuery("SELECT COUNT('id') as pengajuan_row FROM pengajuan WHERE approve = 'REJECT '");

			$data['pengajuans'] = $this->mymodel->selectWithQuery("SELECT * FROM pengajuan LIMIT 10");
		}

		if($this->session->userdata('role_id') == '17'){
			$this->template->load('template/template','template/index',$data);
		} else {
			$this->template->load('template/template_user','template/index',$data);
		}
	}
}