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
	private $default_url="kuantitasharga/admin/";
	private $default_view="kuantitasharga/admin/";
	private $view="template/backend";
	private $id="pekerjaan_id";

	private $atributcetak=[
		'tempat'=>'magelang',
		'ttd'=>'Prasetio Dwi Nugroho,ST',
	];
	private function global_set($data){
		$data=array(
			'menu'=>'laporan',
			'submenu_menu'=>'kuantitas harga',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/kuantitasharga/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'kuatnitas & harga',
			'url'=>'kuantitasharga/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'satuanpekerjaan_tahunanggaran'=>$this->input->post('satuanpekerjaan_tahunanggaran'),
				'satuanpekerjaan_kegiatan'=>$this->input->post('satuanpekerjaan_kegiatan'),
				'satuanpekerjaan_satuanpekerjaan'=>$this->input->post('satuanpekerjaan_satuanpekerjaan'),
				'satuanpekerjaan_lokasi'=>$this->input->post('satuanpekerjaan_lokasi'),
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
			$query=array(
				'tabel'=>$this->master_tabel,
				'order'=>array('kolom'=>'pekerjaan_kegiatan','orderby'=>'ASC'),
			);
			$data=array(
				'pekerjaan'=>$this->Crud->read($query)->result(),
				'global'=>$global,
				'menu'=>$this->menu(),
			);			
			$this->load->view($this->view,$data);
		}	
	}
	public function cari(){
		$id=$this->input->post('id');
		$global_set=array(
			'headline'=>'kuantitas & harga',
			'url'=>'kuantitasharga/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query="SELECT d.pekerjaan_kegiatan,a.analisapekerjaan_kegiatan,a.analisapekerjaan_overhead,b.analisadetail_idhargasatuan,c.hargasatuan_kode,c.hargasatuan_uraian,c.hargasatuan_hargasatuan,z.satuan_kode FROM analisapekerjaan a 
			JOIN analisadetail b ON b.analisadetail_idanalisapekerjaan=a.analisapekerjaan_id
			JOIN hargasatuan c ON c.hargasatuan_id=b.analisadetail_idhargasatuan
			JOIN pekerjaan d ON d.pekerjaan_id=a.analisapekerjaan_idpekerjaan
			JOIN satuan z ON z.satuan_id=a.analisapekerjaan_idsatuan
			WHERE md5(a.analisapekerjaan_idpekerjaan)='$id'";
		$taksiran="SELECT c.pekerjaan_kegiatan,a.analisa_id,b.*,d.satuan_kode,d.satuan_satuan FROM analisa a 
			JOIN taksiran b ON b.taksiran_id=a.analisa_idtafsiran
			JOIN pekerjaan c ON c.pekerjaan_id=a.analisa_idpekerjaan
			JOIN satuan d ON d.satuan_id=b.taksiran_satuan
			WHERE md5(a.analisa_idpekerjaan)='$id'";
		$res=$this->Crud->hardcode($query)->result();
		$taksisanres=$this->Crud->hardcode($taksiran)->result();
		//AMBIL NAMA PEKERJAAN DARI ARRAY DIATAS
		if($res){
			$pekerjaankegiatan=$res[0]->pekerjaan_kegiatan;
		}else{
			$pekerjaankegiatan='tidak ditemukan';
		}
		$data=array(
			'global'=>$global,
			'data'=>$res,
			'taksiran'=>$taksisanres,
			'namaproyek'=>$pekerjaankegiatan,
		);
		$this->load->view($this->default_view.'tabel',$data);		
		//$this->dump_data($data);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add pekerjaan',
			'url'=>'kuantitasharga/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'kuantitasharga/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$data=array(
				'satuanpekerjaan_tahunanggaran'=>$this->input->post('satuanpekerjaan_tahunanggaran'),
				'satuanpekerjaan_kegiatan'=>$this->input->post('satuanpekerjaan_kegiatan'),
				'satuanpekerjaan_satuanpekerjaan'=>$this->input->post('satuanpekerjaan_satuanpekerjaan'),
				'satuanpekerjaan_lokasi'=>$this->input->post('satuanpekerjaan_lokasi'),
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
	public function cetak($id=null){
		$config=$this->atributcetak;
		$global_set=array(
			'headline'=>'laporan kuantitas & harga',
			'url'=>'kuantitasharga/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query="SELECT d.pekerjaan_kegiatan,a.analisapekerjaan_kegiatan,a.analisapekerjaan_overhead,b.analisadetail_idhargasatuan,c.hargasatuan_kode,c.hargasatuan_uraian,c.hargasatuan_hargasatuan,z.satuan_kode FROM analisapekerjaan a 
			JOIN analisadetail b ON b.analisadetail_idanalisapekerjaan=a.analisapekerjaan_id
			JOIN hargasatuan c ON c.hargasatuan_id=b.analisadetail_idhargasatuan
			JOIN pekerjaan d ON d.pekerjaan_id=a.analisapekerjaan_idpekerjaan
			JOIN satuan z ON z.satuan_id=a.analisapekerjaan_idsatuan
			WHERE md5(a.analisapekerjaan_idpekerjaan)='$id'";
		$taksiran="SELECT c.pekerjaan_kegiatan,a.analisa_id,b.*,d.satuan_kode,d.satuan_satuan FROM analisa a 
			JOIN taksiran b ON b.taksiran_id=a.analisa_idtafsiran
			JOIN pekerjaan c ON c.pekerjaan_id=a.analisa_idpekerjaan
			JOIN satuan d ON d.satuan_id=b.taksiran_satuan
			WHERE md5(a.analisa_idpekerjaan)='$id'";
		$res=$this->Crud->hardcode($query)->result();
		$taksisanres=$this->Crud->hardcode($taksiran)->result();
		//AMBIL NAMA PEKERJAAN DARI ARRAY DIATAS
		if($res){
			$pekerjaankegiatan=$res[0]->pekerjaan_kegiatan;
		}else{
			$pekerjaankegiatan='tidak ditemukan';
		}
		$data=array(
			'global'=>$global,
			'data'=>$res,
			'taksiran'=>$taksisanres,
			'namaproyek'=>$pekerjaankegiatan,
			'config'=>$config,
		);
		$cetak=[
			'view'=>$this->load->view($this->default_view.'cetak',$data,true),
			'judul'=>$global_set['headline'],	
		];
		$this->cetaklanscape($cetak);		
		//$this->load->view($this->default_view.'cetak',$data,false);
		//$this->dump_data($data);
	}	
}
