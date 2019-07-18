
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Role extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$data['page_name'] = "role";
			if($this->session->userdata('role_id') == '17'){
				$this->template->load('template/template','role/all-role',$data);
	        } else {
				echo "<script>window.history.back()</script>";
	        }
		}

		// public function create()
		// {
		// 	$data['page_name'] = "role";
		// 	$this->template->load('template/template','role/add-role',$data);
		// }


	// 	public function validate()
	// 	{
	// 		$this->form_validation->set_error_delimiters('<li>', '</li>');
	// $this->form_validation->set_rules('dt[role]', '<strong>Role</strong>', 'required');
	// }

		// public function store()
		// {
		// 	$this->validate();
	 //    	if ($this->form_validation->run() == FALSE){
		// 		$this->alert->alertdanger(validation_errors());     
	 //        }else{
	 //        	$dt = $_POST['dt'];
		// 		$dt['created_at'] = date('Y-m-d H:i:s');
		// 		$dt['status'] = "ENABLE";
		// 		$str = $this->db->insert('role', $dt);
		// 		$last_id = $this->db->insert_id();$this->alert->alertsuccess('Success Send Data');   
					
		// 	}
		// }

		public function json()
		{
			header('Content-Type: application/json');
	        $this->datatables->select('id,role');
	        $this->datatables->from('role');
	        $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Edit</button></div>', 'id');
	        echo $this->datatables->generate();
		}
		public function edit($id)
		{
			$data['role'] = $this->mymodel->selectDataone('role',array('id'=>$id));$data['page_name'] = "role";
			$this->template->load('template/template','role/edit-role',$data);
		}

		public function update()
		{
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			
			$this->validate();
			

	    	if ($this->form_validation->run() == FALSE){
				$this->alert->alertdanger(validation_errors());     
	        }else{
					$id = $this->input->post('id', TRUE);	
					$mn = json_encode($_POST['menu']);


					$dt = $_POST['dt'];
					$dt['menu'] = $mn;
					$dt['updated_at'] = date("Y-m-d H:i:s");
					$this->mymodel->updateData('role', $dt , array('id'=>$id));
					$this->alert->alertsuccess('Success Update Data');  }
		}

		// public function delete()
		// {
		// 		$id = $this->input->post('id', TRUE);$this->alert->alertdanger('Success Delete Data');     
		// }

		// public function status($id,$status)
		// {
		// 	$this->mymodel->updateData('role',array('status'=>$status),array('id'=>$id));
		// 	redirect('role');
		// }


	}
?>