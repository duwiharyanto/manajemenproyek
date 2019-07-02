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
		'cv'=>'CV. ADHI KARYA NUGRAHA',
		'tempat'=>'magelang',
		'ttd'=>'Prasetio Dwi Nugroho, ST',
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
		$pekerjaan=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('md5(pekerjaan_id)'=>$id)),
		);
		// $q_analisapekerjaan=array(
		// 	'tabel'=>'analisapekerjaan',
		// 	'where'=>array(array('md5(analisapekerjaan_idpekerjaan)'=>$id)),
		// );
		$q_analisapekerjaan=[
			'select'=>'a.*,b.satuan_satuan',
			'tabel'=>'analisapekerjaan a',
			'join'=>[
				['tabel'=>'satuan b','ON'=>'b.satuan_id=a.analisapekerjaan_idsatuan','jenis'=>'INNER']
			],
			'where'=>[
				['md5(analisapekerjaan_idpekerjaan)'=>$id],
			],
		];			
		$r_analisapekerjaan=$this->Crud->join($q_analisapekerjaan)->result();
		$detailanalisapekerjaan=array();	
		if($r_analisapekerjaan){
			foreach ($r_analisapekerjaan as $index => $row) {
				$detailanalisapekerjaan[$index]=$row;
				$q_detailanalisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.hargasatuan_hargasatuan FROM analisadetail a 
					JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
					WHERE a.analisadetail_idanalisapekerjaan=$row->analisapekerjaan_id";
				$r_detailanalisapekerjaan=$this->Crud->hardcode($q_detailanalisapekerjaan)->result();
				$jumlah=0;
				$jumlahtotal=0;
				$nilaioverhead=0;
				foreach ($r_detailanalisapekerjaan as $index2 => $rows) {
					$jumlah+=intval($rows->analisadetail_koefisien)*intval($rows->hargasatuan_hargasatuan);
					$jumlahtotal=$jumlah;
					$nilaioverhead=intval(($jumlahtotal*$row->analisapekerjaan_overhead)/100);
				}
				$detailanalisapekerjaan[$index]->jumlah=$jumlahtotal;
				$detailanalisapekerjaan[$index]->nilaioverhead=$nilaioverhead;
				$detailanalisapekerjaan[$index]->hargasatuan=$nilaioverhead+$jumlahtotal;
			}			
		}		
		$data=array(
			'global'=>$global,
			'pekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'data'=>$detailanalisapekerjaan,
		);
		$this->load->view($this->default_view.'detailpekerjaan',$data);		
		//$this->dump_data($data);
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
			'headline'=>'laporan harga satuan pekerjaan',
			'url'=>'satuanpekerjaan/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$pekerjaan=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('md5(pekerjaan_id)'=>$id)),
		);
		$q_analisapekerjaan=[
			'select'=>'a.*,b.satuan_satuan',
			'tabel'=>'analisapekerjaan a',
			'join'=>[
				['tabel'=>'satuan b','ON'=>'b.satuan_id=a.analisapekerjaan_idsatuan','jenis'=>'INNER']
			],
			'where'=>[
				['md5(analisapekerjaan_idpekerjaan)'=>$id],
			],
		];	
		$r_analisapekerjaan=$this->Crud->join($q_analisapekerjaan)->result();
		$detailanalisapekerjaan=array();	
		if($r_analisapekerjaan){
			foreach ($r_analisapekerjaan as $index => $row) {
				$detailanalisapekerjaan[$index]=$row;
				$q_detailanalisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.hargasatuan_hargasatuan FROM analisadetail a 
					JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
					WHERE a.analisadetail_idanalisapekerjaan=$row->analisapekerjaan_id";
				$r_detailanalisapekerjaan=$this->Crud->hardcode($q_detailanalisapekerjaan)->result();
				$jumlah=0;
				$jumlahtotal=0;
				$nilaioverhead=0;
				foreach ($r_detailanalisapekerjaan as $index2 => $rows) {
					$jumlah+=intval($rows->analisadetail_koefisien)*intval($rows->hargasatuan_hargasatuan);
					$jumlahtotal=$jumlah;
					$nilaioverhead=intval(($jumlahtotal*$row->analisapekerjaan_overhead)/100);
				}
				$detailanalisapekerjaan[$index]->jumlah=$jumlahtotal;
				$detailanalisapekerjaan[$index]->nilaioverhead=$nilaioverhead;
				$detailanalisapekerjaan[$index]->hargasatuan=$nilaioverhead+$jumlahtotal;
			}			
		}
		$data=array(
			'global'=>$global,
			'pekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'data'=>$detailanalisapekerjaan,
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
