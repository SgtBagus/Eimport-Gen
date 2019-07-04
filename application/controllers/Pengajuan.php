
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Pengajuan extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$data['page_name'] = "pengajuan";
	        if($this->session->userdata('role_id') != '24'){
				$this->template->load('template/template','pengajuan/all-pengajuan',$data);
	        } else {
				$this->template->load('template/template_user','pengajuan/all-pengajuan',$data);
	        }
		}

		public function create()
		{
			$data['page_name'] = "pengajuan";
	        if($this->session->userdata('role_id') != '24'){
				$this->template->load('template/template','pengajuan/add-pengajuan',$data);
	        } else {
				$this->template->load('template/template_user','pengajuan/add-pengajuan',$data);
	        }
		}


		public function validate()
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>');
	$this->form_validation->set_rules('dt[user_id]', '<strong>User Id</strong>', 'required');
$this->form_validation->set_rules('dt[judul]', '<strong>Judul</strong>', 'required');
$this->form_validation->set_rules('dt[keterangan]', '<strong>Keterangan</strong>', 'required');
$this->form_validation->set_rules('dt[approve]', '<strong>Approve</strong>', 'required');
// $this->form_validation->set_rules('dt[note]', '<strong>Note</strong>', 'required');
	}

		public function store()
		{
			$this->validate();
	    	if ($this->form_validation->run() == FALSE){
				$this->alert->alertdanger(validation_errors());     
	        }else{
	        	$dt = $_POST['dt'];
				$dt['created_at'] = date('Y-m-d H:i:s');
				$dt['status'] = "ENABLE";
				$str = $this->db->insert('pengajuan', $dt);
				$last_id = $this->db->insert_id();$this->alert->alertsuccess('Success Send Data');   
					
			}
		}

		public function json()
		{
			$status = $_GET['status'];
			if($status==''){
				$status = 'ENABLE';
			}
			header('Content-Type: application/json');
	        $this->datatables->select('id,user_id,judul,keterangan,approve,note,status');
	        $this->datatables->where('status',$status);
	        $this->datatables->from('pengajuan');
	        if($status=="ENABLE"){
	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');

	    	}else{
	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button><button type="button" onclick="hapus($1)" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Hapus</button></div>', 'id');

	    	}
	        echo $this->datatables->generate();
		}
		public function edit($id)
		{
			$data['pengajuan'] = $this->mymodel->selectDataone('pengajuan',array('id'=>$id));$data['page_name'] = "pengajuan";

	        if($this->session->userdata('role_id') != '24'){
				$this->template->load('template/template','pengajuan/edit-pengajuan',$data);
	        } else {
				$this->template->load('template/template_user','pengajuan/edit-pengajuan',$data);
	        }
		}

		public function update()
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			
			$this->validate();
			

	    	if ($this->form_validation->run() == FALSE){
				$this->alert->alertdanger(validation_errors());     
	        }else{
				$id = $this->input->post('id', TRUE);		$dt = $_POST['dt'];
					$dt['updated_at'] = date("Y-m-d H:i:s");
					$this->mymodel->updateData('pengajuan', $dt , array('id'=>$id));
					$this->alert->alertsuccess('Success Update Data');  }
		}

		public function delete()
		{
				$id = $this->input->post('id', TRUE);$this->alert->alertdanger('Success Delete Data');     
		}

		public function status($id,$status)
		{
			$this->mymodel->updateData('pengajuan',array('status'=>$status),array('id'=>$id));
			redirect('Pengajuan');
		}


	}
?>