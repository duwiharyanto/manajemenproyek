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
	private $master_tabel="analisapekerjaan";
	private $default_url="satuanpekerjaan/admin/";
	private $default_view="satuanpekerjaan/admin/";
	private $view="template/backend";
	private $id="analisapekerjaan_id";

	//
	private $atributcetak=[
		'tempat'=>'magelang',
		'ttd'=>'Prasetio Dwi Nugroho,ST',
	];
	private function global_set($data){
		$data=array(
			'menu'=>'laporan',
			'submenu_menu'=>'satuan pekerjaan',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/satuanpekerjaan/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'harga satuan pekerjaan',
			'url'=>'satuanpekerjaan/admin/',
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
				'tabel'=>'pekerjaan',
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
			'headline'=>'rincian pekerjaan',
			'url'=>'satuanpekerjaan/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query="SELECT a.analisapekerjaan_idpekerjaan,a.analisapekerjaan_overhead,a.analisapekerjaan_kegiatan,a.analisapekerjaan_kode,b.analisadetail_idhargasatuan,c.hargasatuan_kode,c.hargasatuan_uraian,c.hargasatuan_hargasatuan,z.satuan_kode FROM analisapekerjaan a 
			LEFT JOIN analisadetail b ON b.analisadetail_idanalisapekerjaan=a.analisapekerjaan_id
			LEFT JOIN hargasatuan c ON c.hargasatuan_id=b.analisadetail_idhargasatuan
			JOIN pekerjaan d ON d.pekerjaan_id=a.analisapekerjaan_idpekerjaan
			JOIN satuan z ON z.satuan_id=a.analisapekerjaan_idsatuan
			WHERE md5(d.pekerjaan_id)='$id'";

		$pekerjaan=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('md5(pekerjaan_id)'=>$id)),
		);
		$res=$this->Crud->hardcode($query)->result();
		$data=array(
			'global'=>$global,
			'pekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'data'=>$res,
		);
		$this->load->view($this->default_view.'detailpekerjaan',$data);		
		//$this->dump_data($id);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add pekerjaan',
			'url'=>'satuanpekerjaan/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'satuanpekerjaan/admin/edit',
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
		//$id=$this->input->post('id');
		$config=$this->atributcetak;
		$global_set=array(
			'headline'=>'laporan rincian pekerjaan',
			'url'=>'satuanpekerjaan/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$query="SELECT a.analisapekerjaan_idpekerjaan,a.analisapekerjaan_overhead,a.analisapekerjaan_kegiatan,a.analisapekerjaan_kode,b.analisadetail_idhargasatuan,c.hargasatuan_kode,c.hargasatuan_uraian,c.hargasatuan_hargasatuan,z.satuan_kode FROM analisapekerjaan a 
			LEFT JOIN analisadetail b ON b.analisadetail_idanalisapekerjaan=a.analisapekerjaan_id
			LEFT JOIN hargasatuan c ON c.hargasatuan_id=b.analisadetail_idhargasatuan
			JOIN pekerjaan d ON d.pekerjaan_id=a.analisapekerjaan_idpekerjaan
			JOIN satuan z ON z.satuan_id=a.analisapekerjaan_idsatuan
			WHERE md5(d.pekerjaan_id)='$id'";

		$pekerjaan=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('md5(pekerjaan_id)'=>$id)),
		);
		$res=$this->Crud->hardcode($query)->result();
		$data=array(
			'global'=>$global,
			'pekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'data'=>$res,
			'config'=>$config,
		);
		$cetak=[
			'view'=>$this->load->view($this->default_view.'cetak',$data,true),	
			'judul'=>$global_set['headline'],
		];	
		$this->prosescetak($cetak);	
		//$this->dump_data($config);
	}	
}
