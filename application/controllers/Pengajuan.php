<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','download'));	
		$this->load->model('Memail');
	}

	public function index()
	{
		$data['page_name'] = "pengajuan";
		if($this->session->userdata('role_id') == '17'){
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

		if($this->session->userdata('role_id') == '17'){
			$this->template->load('template/template','pengajuan/add-pengajuan',$data);
		} else {
			$this->template->load('template/template_user','pengajuan/add-pengajuan',$data);
		}
	}


	public function history_insert($user_id, $pengajuan_id, $title, $history, $history_status){
		$his['user_id'] = $user_id;
		$his['pengajuan_id'] = $pengajuan_id;
		$his['title'] = $title;
		$his['history'] = $history;
		$his['history_status'] = $history_status;
		$his['status'] = 'ENABLE';
		$his['created_at'] = date('Y-m-d H:i:s');

		$this->db->insert('history', $his);
	}

	public function notif_insert($user_id, $role_id, $pengajuan_id, $title, $notif_desc){

		$notif['user_id'] = $user_id;
		$notif['role_id'] = $role_id;
		$notif['pengajuan_id'] = $pengajuan_id;
		$notif['title'] = $title;
		$notif['notif_desc'] = $notif_desc;
		$notif['read_on'] = 'ENABLE';
		$notif['status'] = 'ENABLE';
		$notif['created_at'] = date('Y-m-d H:i:s');

		$this->db->insert('notifications', $notif);
	}

	public function validate()
	{
		$no = 1;
		$konfig['konfig'] = $this->mymodel->selectDataone('konfig', array('SLUG'=>'FILE UPLOAD'));

		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('dt[judul]', '<strong>Judul</strong>', 'required');
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
			$dt['updated_at'] = date('Y-m-d H:i:s');
			$dt['status'] = "ENABLE";
			$str = $this->db->insert('pengajuan', $dt);

			$pengajuan_last_id = $this->db->insert_id();

			$dt_code['code'] = 'PL_'.$this->session->userdata('id').'-'.date("Ymd").'.'.$pengajuan_last_id;
			$this->mymodel->updateData('pengajuan', $dt_code , array('id'=>$pengajuan_last_id));

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
				$dtd['updated_at'] = date('Y-m-d H:i:s');
				$str = $this->db->insert('pengajuan_detail', $dtd);

				$last_id = $this->db->insert_id();

				if (!empty($_FILES['file-'.$no]['name'])){
					$dir  = "webfile/pdf/";
					$config['upload_path']          = $dir;
					$config['allowed_types']        = '*';
					$config['file_name']           = md5('pdffile').rand(1000,100000);
					
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
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s')
						);
						$str = $this->db->insert('file', $data); 
					} 
				}
			}
			
			$this->history_insert(
				$this->session->userdata('id'),
				$pengajuan_last_id,
				'PENGAJUAN DIBUAT',
				'Pengajuan Berhasil Dibuat dan Menunggu Di konfirmasi',
				'INFO',
				'ENABLE',
				date('Y-m-d H:i:s')
			);

			$this->notif_insert(
				$this->session->userdata('id'),
				'17',
				$pengajuan_last_id,
				'PENGAJUAN PL_'.$this->session->userdata('id').'-'.date("Ymd").'.'.$pengajuan_last_id,
				'Perlu Dikonfirmasi'
			);

			$approvers = $this->mymodel->selectWhere('user', array('role_id' => '17'));
			$link = base_url('pengajuan/view/').$pengajuan_last_id;



			foreach ($approvers as $approver) {
				if($approver['verification']){
					$this->Memail->send_email(
						$approver['email'], 
						$approver['name'], 
						'Pengajuan Baru Telah Dibuat !', 
						'Pengajuan Baru Telah Dibuat mohon untuk di konfirmasi pengajuan tersebut dengan menekan tombol dibawah ini', 
						'<a href="'.$link.'" style="text-decoration:none; color:#FFF;" target="_blank">
						<button style="color:#FFF; background-color: #007aff; border:0px; border-radius: 100px; height:60px; width:200px; font-family:Verdana, Arial; font-size:20px; font-weight:bold;" align="center">
						Lihat Pengajuan !
						</button>
						</a>'
					);
				}
			}
			$this->alert->alertsuccess('Success Send Data');   
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

		$this->datatables->add_column(
			'view', 
			'<button type="button" class="btn btn-sm btn-info" onclick="view($1)">
			<i class="fa fa-eye"></i>
			</button>', 
			'id'
		);

		echo $this->datatables->generate();
	}

	public function view($id)
	{

		$data['page_name'] = "pengajuan";
		$data['pengajuan'] = $this->mymodel->selectDataone('pengajuan',array('id'=>$id));

		if(!$data['pengajuan']){
  			$this->load->view('errors/html/error_pengajuan');

  			return false;
		}

		$data['detail'] = $this->mymodel->selectWhere('pengajuan_detail', array('pengajuan_id'=>$id));
		$data['historys'] = $this->mymodel->selectWithQuery(
			'select * from history where pengajuan_id = '.$id.' ORDER BY id DESC'
		);

		if($this->session->userdata('role_id') == '17'){
			$this->template->load('template/template','pengajuan/view-pengajuan',$data);
		} else {
			$this->template->load('template/template_user','pengajuan/view-pengajuan',$data);
		}
	}
	
	public function approve($id)
	{
		$data_master['approve'] = $_POST['dt']['approve'];
		$data_master['note'] = $_POST['dt']['note'];
		$data_master['updated_at'] = date('Y-m-d H:i:s');

		$this->mymodel->updateData('pengajuan', $data_master , array('id'=>$id));

		$data_detail_row = $this->mymodel->selectWithQuery("SELECT COUNT('id') as ROW FROM pengajuan_detail WHERE pengajuan_id = '".$id."'");
		$no = 1;
		for($no; $no<=$data_detail_row[0]['ROW']; $no++){
			$detail_id = $_POST['dtd']['pengajuan_'.$no];
			$data_detail['note'] = $_POST['dtd']['note_detail_'.$no];

			if($this->session->userdata('role_id') == '17'){
				$data_detail['approve'] = $_POST['dtd']['approve_detail_'.$no];
			} else if($this->session->userdata('role_id') == '23'){
				$data_detail['approve2'] = $_POST['dtd']['approve_detail_'.$no];
			}
			$data_detail['updated_at'] = date('Y-m-d H:i:s');

			$this->mymodel->updateData('pengajuan_detail', $data_detail , array('id'=>$detail_id));

			if($this->session->userdata('role_id') == '17'){
				if($_POST['dtd']['approve_detail_'.$no] == 'REJECT'){
					$data_detail_reject['approve2'] = 'REJECT';
					$data_detail_reject['updated_at'] = date('Y-m-d H:i:s');
					$this->mymodel->updateData('pengajuan_detail', $data_detail_reject , array('pengajuan_id'=>$id));
				}
			}

		}

		$histo_title = '';
		$histo_history = '';
		$histo_history_status = '';
		if($_POST['dt']['approve'] == 'PROCESS2'){
			$histo_title = 'PENGAJUAN DIKONFIRMASI';
			$histo_history = 'Pengajuan Dikonfirmasi dan Menunggu Dikonfirmasi Lapangan';
			$histo_history_status = 'WARNING';
		} else if($_POST['dt']['approve'] == 'ACCEPT'){
			$histo_title = 'PENGAJUAN DITERIMA';
			$histo_history = 'Pengajuan Diterima';
			$histo_history_status = 'SUCCESS';
		}
		else {
			$histo_title = 'PENGAJUAN DITOLAK';
			$histo_history = 'Pengajuan Ditolak Mohon untuk mengupload Ulang';
			$histo_history_status = 'DANGER';
		}

		$this->history_insert(
			$this->session->userdata('id'),
			$id,
			$histo_title,
			$histo_history,
			$histo_history_status
		);

		$pg = $this->mymodel->selectWhere('pengajuan', array('id' => $id));
		$desc_notif = '';

		if($_POST['dt']['approve'] == 'PROCESS2'){
			$desc_notif = 'Pengajuan Anda Dikirim Lapangan';
		} else if($_POST['dt']['approve'] == 'ACCEPT'){
			$desc_notif = 'Pengajuan Anda Diterima Lapangan';
		} else {
			$desc_notif = 'Pengajuan Anda Ditolak';
		}

		$this->notif_insert(
			$pg[0]['user_id'],
			'24',
			$id,
			'PENGAJUAN '.$pg[0]['code'],
			$desc_notif
		);


		if($this->session->userdata('role_id') == '17'){

			$notif_lapangan = '';

			if($_POST['dt']['approve'] == 'PROCESS2'){
				$notif_lapangan = 'Menunggu untuk Dikonfirmasi Lapangan';
			}else {
				$notif_lapangan = 'Ditolak Mohon untuk mengupload Ulang';
			}

			$this->notif_insert(
				$pg[0]['user_id'],
				'23',
				$id,
				'PENGAJUAN '.$pg[0]['code'],
				$notif_lapangan
			);

		}

		$user_email = $this->mymodel->selectWhere('user', array('id' => $pg[0]['user_id']));

		$link = base_url('pengajuan/view/').$id;
		$email_title = '';
		$email_content = '';
		if($_POST['dt']['approve'] == 'PROCESS2'){
			$email_title = 'Pengajuan Anda Telah Dikonfirmasi';
			$email_content = 'Pengajuan <b>'.$pg[0]['code'].'</b> anda telah di konfirmasi dan telah di kirim ke lapangan';
		}else if ($_POST['dt']['approve'] == 'ACCEPT'){
			$email_title = 'Pengajuan Anda Di Terima';
			$email_content = 'Pengajuan <b>'.$pg[0]['code'].'</b> anda telah di terima di lapangan';
		}else {
			$email_title = 'Pengajuan Anda Di Tolak';
			$email_content = 'Pengajuan <b>'.$pg[0]['code'].'</b> anda telah ditolak';
		}
		$this->Memail->send_email(
			$user_email[0]['email'], 
			$user_email[0]['name'], 
			$email_title,
			$email_content,
			'<a href="'.$link.'" style="text-decoration:none; color:#FFF;" target="_blank">
			<button style="color:#FFF; background-color: #007aff; border:0px; border-radius: 100px; height:60px; width:200px; font-family:Verdana, Arial; font-size:20px; font-weight:bold;" align="center">
			Lihat Pengajuan !
			</button>
			</a>'
		);
		if($_POST['dt']['approve'] == 'PROCESS2'){
			$this->alert->alertwarning('Data Di Kirim Ke Lapangan !');
		} else if($_POST['dt']['approve'] == 'ACCEPT'){
			$this->alert->alertsuccess('Data Diterima !');
		} else {
			$this->alert->alertdanger('Data Ditolak !');
		}
	}


	public function delete($id)
	{
		$this->mymodel->deleteData('pengajuan',array('id'=>$id));
		$files = $this->mymodel->selectWhere('pengajuan_detail', array('pengajuan_id' => $id));
		foreach ($files as $file) {
			$unlink = $this->mymodel->selectDataone('file',array('table_id'=>$file['id'],'table'=>'pengajuan_detail'));
			@unlink($unlink['dir']);

			$this->mymodel->deleteData('file',array('table_id'=>$file['id'], 'table'=>'pengajuan_detail'));
		}

		$history['user_id'] = $this->session->userdata('id');
		$history['pengajuan_id'] = $id;
		$history['title'] = 'PENGAJUAN DIHAPUS';
		$history['history'] = 'Pengajuan Telah di Hapus';
		$history['history_status'] = 'DANGER';
		$history['status'] = "ENABLE";
		$history['created_at'] = date('Y-m-d H:i:s');
		

		$str = $this->db->insert('history', $history);

		redirect('pengajuan/?delete=true');
	}


	public function download($id){
		$file_name = $this->mymodel->selectDataone('pengajuan_detail', array('id'=>$id));

		$file = $this->mymodel->selectDataone('file',
			array('table'=>'pengajuan_detail', 'table_id'=>$id));

		force_download($file_name['file'], file_get_contents('webfile/pdf/'.$file['name'],NULL));	
	}
}

?>