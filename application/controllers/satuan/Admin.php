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
	private $master_tabel="satuan";
	private $default_url="satuan/admin/";
	private $default_view="satuan/admin/";
	private $view="template/backend";
	private $id="satuan_id";

	private function global_set($data){
		$data=array(
			'menu'=>'master',
			'submenu_menu'=>'satuan',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/satuan/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'satuan',
			'url'=>'satuan/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('satuan_satuan')){
			//PROSES SIMPAN
			$data=array(
				'satuan_satuan'=>$this->input->post('satuan_satuan'),
				'satuan_kode'=>$this->input->post('satuan_kode'),
				'satuan_status'=>$this->input->post('satuan_status'),
			);
			$query=array(
				'data'=>$data,
				'tabel'=>$this->master_tabel,
			);
			$insert=$this->Crud->insert($query);
			if($insert){
				$data['success']="Data berhasil disimpan";
			}else{
				$data['error']="Data gagal disimpan, msg : ".$insert;
			}
			$this->output->set_output(json_encode($data));
			//$this->notifiaksi($insert);
			//redirect(site_url($this->default_url));
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
			'headline'=>'satuan satuan',
			'url'=>'satuan/admin/',
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
			'headline'=>'add satuan',
			'url'=>'satuan/admin/', //AKAN DIREDIRECT KE INDEX
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

		$this->load->view($this->default_view.'modaladd',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>$this->default_url,
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('satuan_satuan')){
			$dataz=array(
				'satuan_satuan'=>$this->input->post('satuan_satuan'),
				'satuan_kode'=>$this->input->post('satuan_kode'),
				'satuan_status'=>$this->input->post('satuan_status'),
			);			
			$query=array(
				'data'=>$dataz,
				'where'=>array($this->id=>$id),
				'tabel'=>$this->master_tabel,
				);
			$update=$this->Crud->update($query);
			if($update){
				$data['success']="Update data berhasil";
				$data['data']=$dataz;
			}else{
				$data['error']="Update data gagal, msg :".$update;
			}
			return $this->output->set_output(json_encode($data));
			//$this->notifiaksi($update);
			//redirect(site_url($this->default_url));
			//$this->dump_data($data);
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
			//$this->load->view($this->default_view.'edit',$data);
			$this->load->view($this->default_view.'modaledit',$data);
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
	public function hapus(){
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array($this->id=>$id),
		);
		$delete=$this->Crud->delete($query);
		if($delete){
			$data['success']="Data berhasil dihapus";
		}else{
			$data['error']="Data gagal dihapus msg : ".$delete;
		}
		return $this->output->set_output(json_encode($data));
		//$this->notifiaksi($delete);
		//redirect(site_url($this->default_url));
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
