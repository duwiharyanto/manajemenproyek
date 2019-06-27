<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/master.php';
class Admin extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userid=$this->session->userdata('user_id');
		$this->userlevel=$this->session->userdata('user_level');
		// if(($this->session->userdata('user_login')<>1) OR ($this->session->userdata('user_level')<>1)){
		// 	redirect(site_url('login/logout'));
		// }
		$this->cek_admin();
	}
	//VARIABEL
	private $master_tabel="kategorisatuan";
	private $default_url="kategori/admin/";
	private $default_view="kategori/admin/";
	private $view="template/backend";
	private $id="kategorisatuan_id";

	private function global_set($data){
		$data=array(
			'menu'=>'master',
			'submenu_menu'=>'kategori',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/kategori/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'kategori',
			'url'=>'kategori/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'kategorisatuan_nama'=>$this->input->post('kategorisatuan_nama'),
				'kategorisatuan_kode'=>$this->input->post('kategorisatuan_kode'),
				'kategorisatuan_dibuat'=>date('Y-m-d',strtotime($this->input->post('kategorisatuan_dibuat'))),
				'kategorisatuan_keterangan'=>$this->input->post('kategorisatuan_keterangan'),
			);
			// $file='fileupload';
			// if($_FILES[$file]['name']){
			// 	if($this->fileupload($this->path,$file)){
			// 		$file=$this->upload->data('file_name');
			// 		$data['pendaftaran_file']=$file;
			// 		//print_r($data);
			// 	}else{
			// 		$this->session->set_flashdata('error',$this->upload->display_errors());
			// 		redirect(site_url($this->default_url));
			// 	}
			// }
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);
			redirect(site_url($this->default_url));
			// print_r($data['menu']);
		}else{
			$data=array(
				'global'=>$global,
				'menu'=>$this->menu(),
			);			
			$this->load->view($this->view,$data);
			//print_r($data['menu'][1]->submenu);
		}	
	}
	public function tabel(){
		$global_set=array(
			'headline'=>'kategori satuan',
			'url'=>'kategori/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query=array(
			'tabel'=>$this->master_tabel,
			'order'=>array('kolom'=>$this->id,'orderby'=>'DESC'),
			);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($query)->result(),
		);
		//print_r($data['data']);
		$this->load->view($this->default_view.'tabel',$data);		
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add kategori',
			'url'=>'kategori/admin/', //AKAN DIREDIRECT KE INDEX
		);
		$admin=array(
			'tabel'=>"admin",
			'order'=>array('kolom'=>'admin_id','orderby'=>'DESC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			//'admin'=>$this->Crud->read($admin)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'kategori/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'kategorisatuan_nama'=>$this->input->post('kategorisatuan_nama'),
				'kategorisatuan_kode'=>$this->input->post('kategorisatuan_kode'),
				'kategorisatuan_dibuat'=>date('Y-m-d',strtotime($this->input->post('kategorisatuan_dibuat'))),
				'kategorisatuan_keterangan'=>$this->input->post('kategorisatuan_keterangan'),
			);
			// $file='fileupload';
			// if($_FILES[$file]['name']){
			// 	if($this->fileupload($this->path,$file)){
			// 		$file=$this->upload->data('file_name');
			// 		$data['pendaftaran_file']=$file;
			// 		//print_r($data);
			// 	}else{
			// 		$this->session->set_flashdata('error',$this->upload->display_errors());
			// 		redirect(site_url($this->default_url));
			// 	}
			// }			
			$query=array(
				'data'=>$data,
				'where'=>array($this->id=>$id),
				'tabel'=>$this->master_tabel,
				);
			$update=$this->Crud->update($query);
			$this->notifiaksi($update);
			redirect(site_url($this->default_url));
		}else{
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array(array($this->id=>$id)),
			);
			$admin=array(
				'tabel'=>"admin",
				'order'=>array('kolom'=>'admin_id','orderby'=>'ASC'),
				);			
			$data=array(
				'data'=>$this->Crud->read($query)->row(),
				'global'=>$global,
			);
			//print_r($data['data']);
			$this->load->view($this->default_view.'edit',$data);
		}
	}	
	public function detail(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'detail pendaftaran',
			'url'=>'admin/pendaftaran/edit',
		);
		$global=$this->global_set($global_set);		
		$id=$this->input->post('id');
		$query=array(
			'select'=>'a.pendaftaran_id,a.pendaftaran_adminid,a.pendaftaran_tgl,a.pendaftaran_judul,a.pendaftaran_keterangan,a.pendaftaran_file,a.pendaftaran_tersimpan,b.admin_adminname,b.admin_email',
			'tabel'=>'pendaftaran a',
			'join'=>array(array('tabel'=>'admin b','ON'=>'b.admin_id=a.pendaftaran_adminid','jenis'=>'inner')),
			'order'=>array('kolom'=>'a.pendaftaran_id','orderby'=>'ASC'),
			'where'=>array(array('a.pendaftaran_id'=>$id)),
		);
		$data=array(
			'data'=>$this->Crud->join($query)->row(),
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detail',$data);		
	}
	public function hapus($id){
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array($this->id=>$id),
		);
		$delete=$this->Crud->delete($query);
		$this->notifiaksi($delete);
		redirect(site_url($this->default_url));
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
