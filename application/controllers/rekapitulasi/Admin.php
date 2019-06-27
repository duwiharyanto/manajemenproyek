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
	private $default_url="rekapitulasi/admin/";
	private $default_view="rekapitulasi/admin/";
	private $view="template/backend";
	private $id="analisapekerjaan_id";

	private $atributcetak=[
		'tempat'=>'magelang',
		'ttd'=>'Prasetio Dwi Nugroho,ST',
	];
	private function global_set($data){
		$data=array(
			'menu'=>'laporan',
			'submenu_menu'=>'rekapitulasi',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/rekapitulasi/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'rekapitulasi kuantitas dan harga',
			'url'=>'rekapitulasi/admin/',
		);
				
		$global=$this->global_set($global_set);
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
	public function cari(){
		$id=$this->input->post('id');
		$global_set=array(
			'headline'=>'rincian pekerjaan',
			'url'=>'rekapitulasi/admin/',
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

		$respekerjaan=$this->Crud->hardcode($query)->result();
		$restaksiran=$this->Crud->hardcode($taksiran)->result();

		//AMBIL NAMA PEKERJAAN DARI ARRAY DIATAS
		if($respekerjaan){
			$pekerjaankegiatan=$respekerjaan[0]->pekerjaan_kegiatan;
			$jumlahsatuanpekerjaan=0;
			foreach ($respekerjaan as $index => $row) {
				$jumlahsatuanpekerjaan+=intval($row->hargasatuan_hargasatuan);
			};
			$arrsatuanpekerjaan=[
				'pekerjaan'=>$pekerjaankegiatan,
				'jumlah'=>$jumlahsatuanpekerjaan,
			];						
		}else{
			$arrsatuanpekerjaan=[
				'pekerjaan'=>'tidak ditemukan',
				'jumlah'=>0,
			];
		}

		if($restaksiran){
			$taksiran="pekerjaan persiapan dan prasarana penunjang";
			$jumlahtaksiran=0;
			foreach ($restaksiran as $index => $row) {
				$jumlahtaksiran+=intval($row->taksiran_hargasatuan);
			};
			$arrtaksiran=[
				'pekerjaan'=>$taksiran,
				'jumlah'=>$jumlahtaksiran,
			];			
		}else{
			$arrtaksiran=[
				'pekerjaan'=>'tidak ditemukan',
				'jumlah'=>0,
			];		
		};
		$rekapitulasi=[
			'0'=>$arrsatuanpekerjaan,
			'1'=>$arrtaksiran,
		];

		$pekerjaan=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('md5(pekerjaan_id)'=>$id)),
		);
		//$pekerjaan="SELECT * FROM pekerjaan WHERE md5(pekerjaan_id)='$id'";		
		$res=$this->Crud->hardcode($query)->result();
		$data=array(
			'global'=>$global,
			'pekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'satuanpekerjaan'=>$arrsatuanpekerjaan,
			'taksiran'=>$arrtaksiran,
			'rekapitulasi'=>$rekapitulasi,
		);
		$this->load->view($this->default_view.'detailpekerjaan',$data);		
		//$this->dump_data($data);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add pekerjaan',
			'url'=>'rekapitulasi/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'rekapitulasi/admin/edit',
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
			'headline'=>'laporan rincian pekerjaan',
			'url'=>'rekapitulasi/admin/',
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

		$respekerjaan=$this->Crud->hardcode($query)->result();
		$restaksiran=$this->Crud->hardcode($taksiran)->result();

		//AMBIL NAMA PEKERJAAN DARI ARRAY DIATAS
		if($respekerjaan){
			$pekerjaankegiatan=$respekerjaan[0]->pekerjaan_kegiatan;
			$jumlahsatuanpekerjaan=0;
			foreach ($respekerjaan as $index => $row) {
				$jumlahsatuanpekerjaan+=intval($row->hargasatuan_hargasatuan);
			};
			$arrsatuanpekerjaan=[
				'pekerjaan'=>$pekerjaankegiatan,
				'jumlah'=>$jumlahsatuanpekerjaan,
			];						
		}else{
			$arrsatuanpekerjaan=[
				'pekerjaan'=>'tidak ditemukan',
				'jumlah'=>0,
			];
		}

		if($restaksiran){
			$taksiran="pekerjaan persiapan dan prasarana penunjang";
			$jumlahtaksiran=0;
			foreach ($restaksiran as $index => $row) {
				$jumlahtaksiran+=intval($row->taksiran_hargasatuan);
			};
			$arrtaksiran=[
				'pekerjaan'=>$taksiran,
				'jumlah'=>$jumlahtaksiran,
			];			
		}else{
			$arrtaksiran=[
				'pekerjaan'=>'tidak ditemukan',
				'jumlah'=>0,
			];		
		};
		$rekapitulasi=[
			'0'=>$arrsatuanpekerjaan,
			'1'=>$arrtaksiran,
		];

		$pekerjaan=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('md5(pekerjaan_id)'=>$id)),
		);
		$res=$this->Crud->hardcode($query)->result();
		$data=array(
			'global'=>$global,
			'pekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'satuanpekerjaan'=>$arrsatuanpekerjaan,
			'taksiran'=>$arrtaksiran,
			'rekapitulasi'=>$rekapitulasi,
			'config'=>$config,
				
		);		
		$cetak=[
			'view'=>$this->load->view($this->default_view.'cetak',$data,true),	
			'judul'=>$global_set['headline'],
		];
		$this->prosescetak($cetak);		
		//print_r($data['rekapitulasi']);
	}
}
