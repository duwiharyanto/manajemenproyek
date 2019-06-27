<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/master.php';
class Admin extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userid=$this->session->userdata('user_id');
		$this->userlevel=$this->session->userdata('user_level');
		if(($this->session->userdata('user_login')<>1) OR ($this->session->userdata('user_level')<>1)){
			redirect(site_url('login/logout'));
		}
	}
	//VARIABEL
	private $master_tabel="hargasatuan";
	private $default_url="hargasatuan/admin/";
	private $default_view="hargasatuan/admin/";
	private $view="template/backend";
	private $id="hargasatuan_id";

	private function global_set($data){
		$data=array(
			'menu'=>'master',
			'submenu_menu'=>'harga satuan',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/hargasatuan/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'harga satuan bahan dan upah pekerja',
			'url'=>'hargasatuan/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			$hargasatuan=$this->pricetag($this->input->post('hargasatuan_hargasatuan'));
			//PROSES SIMPAN
			$data=array(
				'hargasatuan_kode'=>$this->input->post('hargasatuan_kode'),
				'hargasatuan_uraian'=>$this->input->post('hargasatuan_uraian'),
				'hargasatuan_hargasatuan'=>$hargasatuan,
				'hargasatuan_satuan'=>$this->input->post('satuan'),
				'hargasatuan_keterangan'=>$this->input->post('hargasatuan_keterangan'),
				'hargasatuan_idkategori'=>$this->input->post('hargasatuan_idkategori'),
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
			'headline'=>'harga satuan',
			'url'=>'hargasatuan/admin/',
		);
		$global=$this->global_set($global_set);		
		$query=array(
			'select'=>'a.*,b.kategorisatuan_nama,b.kategorisatuan_kode,c.satuan_kode',
			'tabel'=>'hargasatuan a',
			'join'=>array(array('tabel'=>'kategorisatuan b','ON'=>' b.kategorisatuan_id=a.hargasatuan_idkategori','jenis'=>'INNER'),
				array('tabel'=>'satuan c','ON'=>' c.satuan_id=a.hargasatuan_satuan','jenis'=>'INNER')
				),
			'order'=>array('kolom'=>$this->id,'orderby'=>'DESC'),
		);		
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->join($query)->result(),
		);
		$this->load->view($this->default_view.'tabel',$data);		
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'tahun akademiks',
			'url'=>'hargasatuan/admin/', //AKAN DIREDIRECT KE INDEX
		);
		$kategori=array(
			'tabel'=>"kategorisatuan",
			'order'=>array('kolom'=>'kategorisatuan_kode','orderby'=>'ASC'),
			);		
		$global=$this->global_set($global_set);
		$data=array(
			'kategori'=>$this->Crud->read($kategori)->result(),
			'global'=>$global,
			);

		$this->load->view($this->default_view.'add',$data);		
	}	
	public function edit(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'edit data',
			'url'=>'hargasatuan/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$hargasatuan=$this->pricetag($this->input->post('hargasatuan_hargasatuan'));
			$data=array(
				'hargasatuan_kode'=>$this->input->post('hargasatuan_kode'),
				'hargasatuan_uraian'=>$this->input->post('hargasatuan_uraian'),
				'hargasatuan_hargasatuan'=>$hargasatuan,
				'hargasatuan_satuan'=>$this->input->post('satuan'),
				'hargasatuan_keterangan'=>$this->input->post('hargasatuan_keterangan'),
				'hargasatuan_idkategori'=>$this->input->post('hargasatuan_idkategori'),
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
				'where'=>array(array('hargasatuan_id'=>$id)),
			);
			$kategori=array(
				'tabel'=>"kategorisatuan",
				'order'=>array('kolom'=>'kategorisatuan_kode','orderby'=>'ASC'),
			);				
			$data=array(
				'kategori'=>$this->Crud->read($kategori)->result(),
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
			'where'=>array('a.pendaftaran_id'=>$id),
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
