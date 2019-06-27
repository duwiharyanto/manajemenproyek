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
	}
	//VARIABEL
	private $master_tabel="taksiran";
	private $default_url="taksiran/admin/";
	private $default_view="taksiran/admin/";
	private $view="template/backend";
	private $id="taksiran_id";

	private function global_set($data){
		$data=array(
			'menu'=>'master',
			'submenu_menu'=>'daftar taksiran',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/taksiran/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'taksiran',
			'url'=>'taksiran/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$hargasatuan=$this->pricetag($this->input->post('taksiran_hargasatuan'));
			$volume=$this->pricetag($this->input->post('taksiran_volume'));
			$data=array(
				'taksiran_kode'=>$this->input->post('taksiran_kode'),
				'taksiran_uraian'=>$this->input->post('taksiran_uraian'),
				'taksiran_volume'=>$volume,
				'taksiran_satuan'=>$this->input->post('satuan'),
				'taksiran_hargasatuan'=>$hargasatuan,
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
			'headline'=>'taksiran',
			'url'=>'taksiran/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query=array(
			'select'=>'a.*,b.satuan_kode',
			'tabel'=>'taksiran a',
			'join'=>array(array('tabel'=>'satuan b','ON'=>'b.satuan_id=a.taksiran_satuan','jenis'=>'INNER'),),
			'order'=>array('kolom'=>'a.taksiran_id','orderby'=>'DESC'),
			);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->join($query)->result(),
		);
		//print_r($data['data']);
		$this->load->view($this->default_view.'tabel',$data);		
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add taksiran',
			'url'=>'taksiran/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'taksiran/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$hargasatuan=$this->pricetag($this->input->post('taksiran_hargasatuan'));
			$volume=$this->pricetag($this->input->post('taksiran_volume'));
			$data=array(
				'taksiran_kode'=>$this->input->post('taksiran_kode'),
				'taksiran_uraian'=>$this->input->post('taksiran_uraian'),
				'taksiran_volume'=>$volume,
				'taksiran_satuan'=>$this->input->post('satuan'),
				'taksiran_hargasatuan'=>$hargasatuan,
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
