
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','download'));	
	}

	public function index()
	{
		$data['page_name'] = "pengajuan";
		if($this->session->userdata('role_id') != '24'){
			$this->template->load('template/template','pengajuan/pengajuan',$data);
		} else {
			$this->template->load('template/template_user','pengajuan/pengajuan',$data);
		}
	}

	public function create()
	{

		$data['page_name'] = "pengajuan";

		$konfig['konfig'] = $this->mymodel->selectDataone('konfig', array('SLUG'=>'FILE UPLOAD'));
		$data['fileupload'] = $konfig['konfig']['value'];

		if($this->session->userdata('role_id') != '24'){
			$this->template->load('template/template','pengajuan/add-pengajuan',$data);
		} else {
			$this->template->load('template/template_user','pengajuan/add-pengajuan',$data);
		}

	}


	public function validate()
	{
		$no = 1;
		$konfig['konfig'] = $this->mymodel->selectDataone('konfig', array('SLUG'=>'FILE UPLOAD'));

		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('dt[judul]', '<strong>Judul</strong>', 'required');
		$this->form_validation->set_rules('dt[keterangan]', '<strong>Keterangan</strong>', 'required');
		for($no; $no<=$konfig['konfig']['value']; $no++){

			$supported_file = array(
			    'pdf'
			);

			$src_file_name = $_FILES['file-'.$no]['name'];
			$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); 
			if (!in_array($ext, $supported_file)) {
				$this->form_validation->set_rules('file-'.$no, '<strong>File '.$no.'</strong>', 'required');
			} 
		}
	}

	public function store()
	{	
		$this->validate();
		if ($this->form_validation->run() == FALSE){
			$this->alert->alertdanger(validation_errors());     
		}else{
			$dt = $_POST['dt'];
			$dt['user_id'] = $this->session->userdata('id');
			$dt['approve'] = 'PROCESS';
			$dt['created_at'] = date('Y-m-d H:i:s');
			$dt['status'] = "ENABLE";
			$str = $this->db->insert('pengajuan', $dt);

			$pengajuan_last_id = $this->db->insert_id();

			$no = 1;
			$konfig['konfig'] = $this->mymodel->selectDataone('konfig', array('SLUG'=>'FILE UPLOAD'));
			for($no; $no<=$konfig['konfig']['value']; $no++){
				$dtd['pengajuan_id'] = $pengajuan_last_id;
				$dtd['file'] = $_FILES['file-'.$no]['name'];
				$dtd['note'] = '';
				$dtd['approve'] = 'PROCESS';
				$dtd['approve2'] = 'PROCESS';
				$dtd['status'] = "ENABLE";
				$dtd['created_at'] = date('Y-m-d H:i:s');
				$str = $this->db->insert('pengajuan_detail', $dtd);

				$last_id = $this->db->insert_id();

				if (!empty($_FILES['file-'.$no]['name'])){
					$dir  = "webfile/";
					$config['upload_path']          = $dir;
					$config['allowed_types']        = '*';
					$config['file_name']           = md5('smartsoftstudio').rand(1000,100000);
					
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('file-'.$no)){
						$error = $this->upload->display_errors();
						$this->alert->alertdanger($error);		
					}else{
						$file = $this->upload->data();
						$data = array(
							'id' => '',
							'name'=> $file['file_name'],
							'mime'=> $file['file_type'],
							'dir'=> $dir.$file['file_name'],
							'table'=> 'pengajuan_detail',
							'table_id'=> $last_id,
							'status'=>'ENABLE',
							'created_at'=>date('Y-m-d H:i:s')
						);
						$str = $this->db->insert('file', $data); 
					} 
				}
			}
			
			$history['user_id'] = $this->session->userdata('id');
			$history['pengajuan_id'] = $pengajuan_last_id;
			$history['title'] = 'PENGAJUAN DIBUAT';
			$history['history'] = 'Pengajuan Berhasil Dibuat dan Menunggu Di konfirmasi';
			$history['history_status'] = 'INFO';
			$history['read_on'] = 'ENABLE';
			$history['status'] = "ENABLE";
			$history['created_at'] = date('Y-m-d H:i:s');
			$str = $this->db->insert('history', $history);

			$this->alert->alertsuccess('Success Send Data');   
		}
	}

	public function json()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,user_id,judul,keterangan,approve,note,status');
		$this->datatables->from('pengajuan');
		if($this->session->userdata('role_id') == '24'){
			$this->datatables->where(array('user_id'=>$this->session->userdata('id')));
		}

	        // $this->datatables->add_column('view', '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" onclick="edit($1)"><i class="fa fa-pencil"></i> Lihat</button></div>', 'id');
		$this->datatables->add_column(
			'view', 
			'<button type="button" class="btn btn-sm btn-info" onclick="view($1)">
			<i class="fa fa-eye"></i>
			</button>
			<button type="button" onclick="hapus($1)" class="btn btn-sm btn-danger">
			<i class="fa fa-trash-o"></i>
			</button>', 
			'id'
		);

		echo $this->datatables->generate();
	}

	public function view($id)
	{
		$data['pengajuan'] = $this->mymodel->selectDataone('pengajuan',array('id'=>$id));
		$data['page_name'] = "pengajuan";

		$data['detail'] = $this->mymodel->selectWhere('pengajuan_detail', array('pengajuan_id'=>$id));
		$data['historys'] = $this->mymodel->selectWithQuery(
			'select * from history where pengajuan_id = '.$id.' ORDER BY id DESC'
		);

		if($this->session->userdata('role_id') != '24'){
			$this->template->load('template/template','pengajuan/view-pengajuan',$data);
		} else {
			$this->template->load('template/template_user','pengajuan/view-pengajuan',$data);
		}
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

		public function approve($id)
		{
			$data_master['approve'] = $_POST['dt']['approve'];
			$data_master['note'] = $_POST['dt']['note'];
			$this->mymodel->updateData('pengajuan', $data_master , array('id'=>$id));
			
			$data_detail_row = $this->mymodel->selectWithQuery("SELECT COUNT('id') as ROW FROM pengajuan_detail WHERE pengajuan_id = '".$id."'");
			
			$no = 1;
			for($no; $no<=$data_detail_row[0]['ROW']; $no++){
				$data_detail['detail_id'] = $_POST['dtd']['pengajuan_'.$no];
				$data_detail['note'] = $_POST['dtd']['note_detail_'.$no];
				$data_detail['approve'] = $_POST['dtd']['approve_detail_'.$no];

				var_dump($data_detail);
				$this->mymodel->updateData('pengajuan_detail', $data_master , array('id'=>$data_detail['detail_id']));
			}

			$history['user_id'] = $_POST['dt']['user_id'];
			$history['pengajuan_id'] = $id;
			$history['title'] = 'PENGAJUAN DIKONFIRMASI';
			$history['history'] = 'Pengajuan Dikonfirmasi dan Menunggu Dikonfirmasi Lapangan';
			$history['history_status'] = 'WARNING';
			$history['read_on'] = 'ENABLE';
			$history['status'] = "ENABLE";
			$history['created_at'] = date('Y-m-d H:i:s');

			$str = $this->db->insert('history', $history);
			
			// $this->alert->alertsuccess('Berhasil Berubah Data');   
			redirect('pengajuan/view/'.$id);
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


		public function download($id){
			$file_name = $this->mymodel->selectDataone('pengajuan_detail', array('id'=>$id));

			$file = $this->mymodel->selectDataone('file',
				array('table'=>'pengajuan_detail', 'table_id'=>$id));

			force_download($file_name['file'], file_get_contents('webfile/'.$file['name'],NULL));	
		}

		public function webfile($id){
			
		}
	}

?>