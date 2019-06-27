<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/master.php';
class Admin extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userid=$this->session->userdata('user_id');
		$this->userlevel=$this->session->userdata('user_level');
		$this->cek_admin();
	}
	//VARIABEL
	private $master_tabel="pekerjaan";
	private $default_url="pekerjaan/admin/";
	private $default_view="pekerjaan/admin/";
	private $view="template/backend";
	private $id="pekerjaan_id";

	private function global_set($data){
		$data=array(
			'menu'=>'analisis',
			'submenu_menu'=>'pekerjaan',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/pekerjaan/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'pekerjaan',
			'url'=>'pekerjaan/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'pekerjaan_tahunanggaran'=>$this->input->post('pekerjaan_tahunanggaran'),
				'pekerjaan_kegiatan'=>$this->input->post('pekerjaan_kegiatan'),
				'pekerjaan_pekerjaan'=>$this->input->post('pekerjaan_pekerjaan'),
				'pekerjaan_lokasi'=>$this->input->post('pekerjaan_lokasi'),
			);
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);
			redirect(site_url($this->default_url));
			//$this->dump_data($data);
		}else{
			$data=array(
				'global'=>$global,
				'menu'=>$this->menu(),
			);			
			$this->load->view($this->view,$data);
		}	
	}
	public function tabel(){
		$global_set=array(
			'headline'=>'pekerjaan',
			'url'=>'pekerjaan/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query=array(
			'tabel'=>'pekerjaan',
			);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($query)->result(),
		);
		$this->load->view($this->default_view.'tabel',$data);
		//$this->dump_data($data['data']);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add pekerjaan',
			'url'=>'pekerjaan/admin/', //AKAN DIREDIRECT KE INDEX
		);		
		$global=$this->global_set($global_set);
		$data=array(
			'global'=>$global,
			);
		$this->load->view($this->default_view.'add',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'pekerjaan/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'pekerjaan_tahunanggaran'=>$this->input->post('pekerjaan_tahunanggaran'),
				'pekerjaan_kegiatan'=>$this->input->post('pekerjaan_kegiatan'),
				'pekerjaan_pekerjaan'=>$this->input->post('pekerjaan_pekerjaan'),
				'pekerjaan_lokasi'=>$this->input->post('pekerjaan_lokasi'),
			);			
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
			$data=array(
				'data'=>$this->Crud->read($query)->row(),
				'global'=>$global,
			);
			$this->load->view($this->default_view.'edit',$data);
		}
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
