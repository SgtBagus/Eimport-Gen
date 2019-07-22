<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approve_pengajuan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','download'));	
	}

	public function index()
	{
		$data['page_name'] = "Pengajuan Di Terima";
		if($this->session->userdata('role_id') == '17'){
			$this->template->load('template/template','approve_pengajuan/index',$data);
		} else {
			$this->template->load('template/template_user','approve_pengajuan/index',$data);
		}
	}

	public function json()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,code,user_id,judul,keterangan,approve,note,status');
		$this->datatables->from('pengajuan');
		if($this->session->userdata('role_id') == '24'){
			$this->datatables->where(array('user_id'=>$this->session->userdata('id')));
		}
		$this->datatables->where(array('approve' => 'ACCEPT'));

		$this->datatables->add_column(
			'view', 
			'<button type="button" class="btn btn-sm btn-info" onclick="view($1)">
			<i class="fa fa-eye"></i>
			</button>', 
			'id'
		);

		echo $this->datatables->generate();
	}

}

?>