<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['page_name'] = "Profil";

        $data['user'] = $this->mymodel->selectDataone('user', array('id' => $this->session->userdata('id')));

        $role = $this->mymodel->selectWhere('role',array('id'=>$this->session->userdata('role_id')));
        $data['role'] =  $role[0]['role']; 

        $pengajuan_query = 'SELECT COUNT(id) AS ROW FROM pengajuan WHERE user_id = '.$this->session->userdata('id');

        $pengajuan = $this->mymodel->selectWithQuery($pengajuan_query);

        $accept_pengajuan = $this->mymodel->selectWithQuery($pengajuan_query." AND approve = 'ACCEPT' ");

        $data['pengajuan'] = $pengajuan[0]['ROW'];
        $data['accept_pengajuan'] = $pengajuan[0]['ROW'];

        $file = $this->mymodel->selectDataone(
            'file',array('table'=>'user', 'table_id'=>$this->session->userdata('id'))
        );

        $data['image'] = $file['name'];

        if($this->session->userdata('role_id') != '24'){ 
            $this->template->load('template/template','user/profil',$data);
        } else {
            $this->template->load('template/template_user','user/profil',$data);
        }
    }

    public function updateProfil()
    {
        $param = $this->input->post();

        $id = $this->session->userdata('id');

        $dataup = array(
            'nib' => $param['nib'],
            'name' => $param['name'],
            'desc' => $param['desc'],
        );

        if($_FILES['file']['name']!='')
        {
            $dir  = "webfile/";
            $config['upload_path']          = $dir;
            $config['allowed_types']        = '*';
            $config['file_name']           = md5('smartsoftstudio').rand(1000,100000);

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ( ! $this->upload->do_upload('file')){
                $error = $this->upload->display_errors();
            }else{
                $file = $this->upload->data();
                $data = array(
                    'name'=> $file['file_name'],
                    'mime'=> $file['file_type'],
                    'dir'=> $dir.$file['file_name'],
                    'table'=> 'user',
                    'table_id'=> $id,
                    'updated_at'=>date('Y-m-d H:i:s')
                );
                $file = $this->mymodel->selectDataone('file',array('table_id'=>$id,'table'=>'user'));
                @unlink($file['dir']);
                if($file==""){
                    $this->mymodel->insertData('file', $data);
                }else{
                    $this->mymodel->updateData('file', $data , array('id'=>$file['id']));
                }
                

                $dataup['updated_at'] = date("Y-m-d H:i:s");
                $this->mymodel->updateData('user', $dataup , array('id'=>$id));

                redirect('/profil/?update=change');
            }
        }else{

            $dataup['updated_at'] = date("Y-m-d H:i:s");
            $this->mymodel->updateData('user', $dataup , array('id'=>$id));

            redirect('/profil/?update=change');
        }
    }

    public function updatePassword(){
        $param = $this->input->post();

        if(md5($param['password']) == md5($param['password_confirmation'])) {
            $pass_db = $this->mymodel->selectDataone('user',array('id' => $this->session->userdata('id')));

            if(md5($param['password_confirmation_last']) == $pass_db['password']){

                $dataup['password'] = md5($param['password']);
                $dataup['updated_at'] = date("Y-m-d H:i:s");

                $this->mymodel->updateData('user', $dataup , array('id'=> $this->session->userdata('id')));

                redirect('profil/?password=change');
            } else {
                redirect('profil/?last_password=required');
            }
        }else {
            redirect('profil/?new_password=required');
        }
    }
}