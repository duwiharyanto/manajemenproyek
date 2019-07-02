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
	//VARIABELs
	private $master_tabel="analisa";
	private $default_url="analisa2/admin/";
	private $default_view="analisa2/admin/";
	private $view="template/backend";
	private $id="analisa_id";
	//ATRIBUT CETAK
	private $atributcetak=[
		'tempat'=>'magelang',
		'ttd'=>'Prasetio Dwi Nugroho,ST',
	];
	private function global_set($data){
		$data=array(
			'menu'=>'analisis',
			'submenu_menu'=>'analisa',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/analisa2/admin/index.php",
			'detail'=>false,
			'edit'=>false,
			'delete'=>true,
		);
		return (object)$data;
	}		
	public function index()
	{
		$global_set=array(
			'headline'=>'analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'analisa_tahunanggaran'=>$this->input->post('analisa_tahunanggaran'),
				'analisa_kegiatan'=>$this->input->post('analisa_kegiatan'),
				'analisa_analisa'=>$this->input->post('analisa_analisa'),
				'analisa_lokasi'=>$this->input->post('analisa_lokasi'),
			);
			// $query=array(
			// 	'data'=>$data,
			// 	'tabel'=>$this->master_tabel,
			// );
			// $insert=$this->Crud->insert($query);
			// $this->notifiaksi($insert);
			// redirect(site_url($this->default_url));
			$this->dump_data($data);
		}else{
			$pekerjaan=array(
				'tabel'=>'pekerjaan',
				'order'=>array('kolom'=>'pekerjaan_tahunanggaran','orderby'=>'DESC'),
			);
			$satuan=array(
				'tabel'=>'hargasatuan',
				'order'=>array('kolom'=>'hargasatuan_id','orderby'=>'DESC'),
			);				
			$data=array(
				'pekerjaan'=>$this->Crud->read($pekerjaan)->result(),
				'satuan'=>$this->Crud->read($satuan)->result(),
				'global'=>$global,
				'menu'=>$this->menu(),
			);			
			$this->load->view($this->view,$data);
		}	
	}
	public function tabel($id=null){
		$global_set=array(
			'headline'=>'detail analisa',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		if(!$id){
			$id=$this->input->post('id');
		}else{
			$id=$id;
		}
		//ANALISA TERDIRI DARI 2 BAGIAN BAGIAN TAFSIRAN DAN SATUAN
		$analisa=array(
			'tabel'=>'analisa',
			'where'=>array(array('analisa_idpekerjaan'=>$id)),
			//'order'=>array('kolom'=>'analisa_analisa','orderby'=>'DESC'),
		);
		$analisa=$this->Crud->read($analisa)->result();	
		$dtanalisasatuan=array();
		$dtanalisatafsiran=array();
		$res=array();
		foreach ($analisa as $index => $row) {
			if(!$row->analisa_idtafsiran){
				$dtanalisasatuan[$index]=$row;
			}else{
				$tafsiran=array(
					'select'=>'a.*,b.*',
					'tabel'=>'analisa a',
					'join'=>array(array('tabel'=>'taksiran b','ON'=>'b.taksiran_id=a.analisa_idtafsiran','jenis'=>'INNER')),
					'order'=>array('kolom'=>'b.taksiran_uraian','orderby'=>'ASC'),
					'where'=>array(array('a.analisa_idpekerjaan'=>$id))
				);
				$res=$this->Crud->join($tafsiran)->result();				
				$dtanalisatafsiran=$res;
				$res=$res;
			}
		}
		//DATA INPUT FORM
		$tafsiran=array(
			'tabel'=>'taksiran',
			'order'=>array('kolom'=>'taksiran_id','orderby'=>'DESC'),
			);		
		$q_analisapekerjaan=array(
			'tabel'=>'analisapekerjaan',
			'where'=>array(array('analisapekerjaan_idpekerjaan'=>$id)),
		);	
		$r_analisapekerjaan=$this->Crud->read($q_analisapekerjaan)->result();
		
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
				foreach ($r_detailanalisapekerjaan as $index2 => $rows) {
					
					$jumlah+=intval($rows->analisadetail_koefisien)*intval($rows->hargasatuan_hargasatuan);
					$jumlahtotal=$jumlah;
				}
				$detailanalisapekerjaan[$index]->jumlah=$jumlahtotal;
			}			
		}
		$data=array(
			'global'=>$global,
			//analisasatuan
			'datasatuan'=>$dtanalisasatuan,
			'datatafsiran'=>$dtanalisatafsiran,
			'analisapekerjaan2'=>$detailanalisapekerjaan,
			'analisapekerjaan'=>$this->Crud->read($q_analisapekerjaan)->result(),
			'tafsiran'=>$this->Crud->read($tafsiran)->result(),
			'pekerjaan_id'=>$id,
			'res'=>$res,
		);
		$this->load->view($this->default_view.'tabel',$data);		
		//$this->dump_data($data['analisapekerjaan2']);
	}
	public function addtafsiran(){
		$global_set=array(
			'headline'=>'add tafsiran',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);			
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('pekerjaan_id'=>$id)),
		);
		$tafsiran=array(
			'tabel'=>'taksiran',
			'order'=>array('kolom'=>'taksiran_id','orderby'=>'DESC'),
			);		
		$data=array(
			'pekerjaan'=>$this->Crud->read($query)->row(),
			'tafsiran'=>$this->Crud->read($tafsiran)->result(),
			'id'=>$id,
			'global'=>$global,
		);
		$this->load->view($this->default_view.'addtafsiran',$data);
		//$this->dump_data($data['pekerjaan']);
	
	}
	public function simpantafsiran(){
		$data=array(
			'idpekerjaan'=>$this->input->post('pekerjaan_id'),
			'tafsiran'=>$this->input->post('analisis_taksiranid'),
		);
		//SIAPKAN DATA INSERT BATCH
		foreach ($data['tafsiran'] as $index => $row) {
			$dt[$index]=array(
				'analisa_idpekerjaan'=>$data['idpekerjaan'],
				'analisa_idtafsiran'=>$row,
			);
		}
		$insert=$this->db->insert_batch('analisa',$dt);
		//$insert=true;
		if($insert){
			$dt['success']='Simpan tafsiran berhasil';
			$dt['id_pekerjaan']=$data['idpekerjaan'];
			//$dt['id_pekerjaan']=3;
		}else{
			$dt['error']='Simpan tafsiran gagal, msg : '.$insert;
		}
		return $this->output ->set_output(json_encode($dt));
		//redirect(base_url($this->default_url));
		//$this->dump_data($dt);
	}
	public function addanalisapekerjaan(){
		$global_set=array(
			'headline'=>'add analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);			
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('pekerjaan_id'=>$id)),
		);	
		$satuan=array(
			'tabel'=>'hargasatuan',
			'order'=>array('kolom'=>'hargasatuan_id','orderby'=>'DESC'),
		);					
		$data=array(
			'pekerjaan'=>$this->Crud->read($query)->row(),
			'satuan'=>$this->Crud->read($satuan)->result(),
			'id'=>$id,
			'global'=>$global,
		);
		$this->load->view($this->default_view.'analisapekerjaan',$data);
		//$this->dump_data($data['pekerjaan']);
	
	}
	public function addanalisapekerjaan2(){
		$global_set=array(
			'headline'=>'analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);			
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>'pekerjaan',
			'where'=>array(array('pekerjaan_id'=>$id)),
		);	
		$satuan=array(
			'tabel'=>'satuan',
			'order'=>array('kolom'=>'satuan_satuan','orderby'=>'DESC'),
		);					
		$data=array(
			'pekerjaan'=>$this->Crud->read($query)->row(),
			'satuan'=>$this->Crud->read($satuan)->result(),
			'id'=>$id,
			'global'=>$global,
		);
		$this->load->view($this->default_view.'analisapekerjaan2',$data);
		//$this->dump_data($data['satuan']);
	
	}	
	public function detailanalisapekerjaan($id=null){
		$global_set=array(
			'headline'=>'detail analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);			
		//$id=$this->input->post('id');
		if(!$id){
			$id=$this->input->post('id');
		}else{
			$id=$id;
		}
		$analisapekerjaan=array(
			'tabel'=>'analisadetail',
			'where'=>array(array('analisadetail_idanalisapekerjaan'=>$id)),
		);
		// $q_analisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.*,c.kategorisatuan_nama,d.satuan_kode FROM analisadetail a 
		// 	JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
		// 	JOIN kategorisatuan c ON c.kategorisatuan_id=b.hargasatuan_idkategori
		// 	JOIN satuan d ON d.satuan_id=b.hargasatuan_satuan";
		//$r_analisapekerjaan=$this->Crud->hardcode($q_analisapekerjaan)->result();	
		$q_kategorisatuan=[
			'select'=>'kategorisatuan_nama,kategorisatuan_id',
			'tabel'=>'kategorisatuan',
		];
		$r_kategorisatuan=$this->Crud->read($q_kategorisatuan)->result();
		$r_detailanalisapekerjaan=array();
		foreach($r_kategorisatuan AS $index => $row){
			$q_analisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.*,c.kategorisatuan_nama,d.satuan_kode FROM analisadetail a 
				JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
				JOIN kategorisatuan c ON c.kategorisatuan_id=b.hargasatuan_idkategori
				JOIN satuan d ON d.satuan_id=b.hargasatuan_satuan
				WHERE c.kategorisatuan_id=$row->kategorisatuan_id AND a.analisadetail_idanalisapekerjaan=$id";
			$r_analisapekerjaan=$this->Crud->hardcode($q_analisapekerjaan)->result();
			if($r_analisapekerjaan){
				$r_detailanalisapekerjaan[$index]=$row;
				$r_detailanalisapekerjaan[$index]->data=$r_analisapekerjaan;					
			}
			
		}
		$pekerjaan=array(
			'tabel'=>'analisapekerjaan',
			'where'=>array(array('analisapekerjaan_id'=>$id)),
		);
		$result=$this->Crud->read($analisapekerjaan)->result();						
		$data=array(
			//'detailanalisapekerjaan'=>$this->Crud->hardcode($q_analisapekerjaan)->result(),
			'detailanalisapekerjaan'=>$r_detailanalisapekerjaan,
			'analisapekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'analisapekerjaan_id'=>$id,
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detailanalisapekerjaan',$data);
		//$this->dump_data($r_detailanalisapekerjaan);
	
	}
	//ADD ANALISIS PEKERJAAN DETAIL SATUAN
	public function addanalisispekerjaan(){
		$global_set=array(
			'headline'=>'add analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);			
		$id=$this->input->post('id');
		$query=array(
			'tabel'=>'analisapekerjaan',
			'where'=>array(array('analisapekerjaan_id'=>$id)),
		);	
		$satuan=array(
			'tabel'=>'hargasatuan',
			'order'=>array('kolom'=>'hargasatuan_id','orderby'=>'DESC'),
		);					
		$data=array(
			'analisapekerjaan'=>$this->Crud->read($query)->row(),
			'satuan'=>$this->Crud->read($satuan)->result(),
			'id'=>$id,
			'global'=>$global,
		);
		$this->load->view($this->default_view.'analisispekerjaan',$data);
	
	}			
	public function simpananalisa(){
		$data=array(
			'analisapekerjaan_idpekerjaan'=>$this->input->post('pekerjaan_id'),
			'analisapekerjaan_kode'=>$this->input->post('analisa_kode'),
			'analisapekerjaan_kegiatan'=>$this->input->post('analisa_kegiatan'),
			'analisapekerjaan_harga'=>$this->input->post('analisa_harga'),
			'analisapekerjaan_overhead'=>$this->input->post('analisa_overhead'),
			'analisapekerjaan_total'=>$this->input->post('analisa_total'),
			'analisapekerjaan_idsatuan'=>$this->input->post('analisapekerjaan_idsatuan'),
			'analisapekerjaan_date'=>date('Y-m-d'),
		);
		// foreach ($data['tafsiran'] as $index => $row) {
		// 	$dt[$index]=array(
		// 		'analisa_idpekerjaan'=>$data['idpekerjaan'],
		// 		'analisa_idtafsiran'=>$row,
		// 	);
		// }
		//$insert=$this->db->insert_batch('analisa',$dt);
		$query=array(
			'tabel'=>'analisapekerjaan',
			'data'=>$data,
		);		
		$insert=$this->Crud->insert($query);			
		if($insert){
			$dt['success']='Simpan tafsiran berhasil';
			$dt['id_pekerjaan']=$data['analisapekerjaan_idpekerjaan'];
			//$dt['id_pekerjaan']=3;
		}else{
			$dt['error']='Simpan tafsiran gagal, msg : '.$insert;
		}
		return $this->output ->set_output(json_encode($dt));
		//redirect(base_url($this->default_url));
		//$this->dump_data($dt);
		//echo 'log';
	}
	public function simpandetailanalisa(){
		$data=array(
			'analisadetail_idanalisapekerjaan'=>$this->input->post('analisadetail_idpekerjaan'),
			'analisadetail_idhargasatuan'=>$this->input->post('analisis_pekerjaanid'),
			'analisadetail_koefisien'=>$this->input->post('koefisien'),
			//'analisapekerjaan_date'=>date('Y-m-d'),
		);
		foreach ($data['analisadetail_idhargasatuan'] as $index => $row) {
			$dt[$index]=array(
				'analisadetail_idanalisapekerjaan'=>$data['analisadetail_idanalisapekerjaan'],
				'analisadetail_idhargasatuan'=>$row,
				'analisadetail_koefisien'=>$data['analisadetail_idanalisapekerjaan'][$index],
				'analisadetail_date'=>date('Y-m-d'),
			);
		}
		$insert=$this->db->insert_batch('analisadetail',$dt);		
		// $query=array(
		// 	'tabel'=>'analisapekerjaan',
		// 	'data'=>$data,
		// );		
		// $insert=$this->Crud->insert($query);			
		if($insert){
			$dt['success']='Simpan tafsiran berhasil';
			$dt['id_pekerjaan']=$data['analisadetail_idanalisapekerjaan'];
		}else{
			$dt['error']='Simpan tafsiran gagal, msg : '.$insert;
		}
		return $this->output ->set_output(json_encode($dt));
		//redirect(base_url($this->default_url));
		//$this->dump_data($dt);
		// echo 'simpan';
	}		
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add analisa',
			'url'=>'analisa2/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'analisa2/admin/edit',
		);
		$global=$this->global_set($global_set);
		$id=$this->input->post('id');
		if($this->input->post('submit')){
			$hargasatuan=$this->pricetag($this->input->post('analisa_hargasatuan'));
			$volume=$this->pricetag($this->input->post('analisa_volume'));
			$data=array(
				'analisa_tahunanggaran'=>$this->input->post('analisa_tahunanggaran'),
				'analisa_kegiatan'=>$this->input->post('analisa_kegiatan'),
				'analisa_analisa'=>$this->input->post('analisa_analisa'),
				'analisa_lokasi'=>$this->input->post('analisa_lokasi'),
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
	public function hapus(){
		$id=$this->input->post('id');
		//$idpekerjaan=$this->input->post('idpekerjaan');
		$query=array(
			'tabel'=>$this->master_tabel,
			'where'=>array($this->id=>$id),
		);
		$delete=$this->Crud->delete($query);
		if($delete){
			$dt['success']='Hapus Berhasil';
			$dt['param']='analisapekerjaan';
		}else{
			$dt['error']='Hapus Gagal, Msg '.$delete;
		}
		return $this->output->set_output(json_encode($dt));
		//$this->notifiaksi($delete);
		//redirect(site_url($this->default_url));
	}
	public function hapusanalisa(){
		$id=$this->input->post('id');
		//$idpekerjaan=$this->input->post('idpekerjaan');
		$query=array(
			'tabel'=>'analisapekerjaan',
			'where'=>array('analisapekerjaan_id'=>$id),
		);
		$delete=$this->Crud->delete($query);
		if($delete){
			$dt['success']='Hapus Berhasil';
			$dt['param']='analisapekerjaan';
		}else{
			$dt['error']='Hapus Gagal, Msg '.$delete;
		}
		return $this->output->set_output(json_encode($dt));
		//$this->notifiaksi($delete);
		//redirect(site_url($this->default_url));
	}	
	public function hapusdetailanalisa(){
		$id=$this->input->post('id');
		//$idpekerjaan=$this->input->post('idpekerjaan');
		$query=array(
			'tabel'=>'analisadetail',
			'where'=>array('analisadetail_id'=>$id),
		);
		$analisapekerjaan=array(
			'tabel'=>'analisadetail',
			'where'=>array(array('analisadetail_id'=>$id)),
		);
		$read=$this->Crud->read($analisapekerjaan)->row();
		$delete=$this->Crud->delete($query);
		if($delete){
			$dt['success']='Hapus Berhasil';
			$dt['idanalisapekerjaan']=$read->analisadetail_idanalisapekerjaan;
		}else{
			$dt['error']='Hapus Gagal, Msg '.$delete;
		}
		return $this->output->set_output(json_encode($dt));
		//$this->notifiaksi($delete);
		//redirect(site_url($this->default_url));
	}

	public function cetak($id=null){
		$config=$this->atributcetak;
		$global_set=array(
			'headline'=>'laporan analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);	
		//QUERY
		$analisa=array(
			'tabel'=>'analisa',
			'where'=>array(array('analisa_idpekerjaan'=>$id)),
		//'order'=>array('kolom'=>'analisa_analisa','orderby'=>'DESC'),
		);
		$analisa=$this->Crud->read($analisa)->result();	
		$dtanalisasatuan=array();
		$dtanalisatafsiran=array();
		$res=array();
		foreach ($analisa as $index => $row) {
			if(!$row->analisa_idtafsiran){
				$dtanalisasatuan[$index]=$row;
			}else{
				$tafsiran=array(
					'select'=>'a.*,b.*',
					'tabel'=>'analisa a',
					'join'=>array(array('tabel'=>'taksiran b','ON'=>'b.taksiran_id=a.analisa_idtafsiran','jenis'=>'INNER')),
					'order'=>array('kolom'=>'b.taksiran_uraian','orderby'=>'ASC'),
					'where'=>array(array('a.analisa_idpekerjaan'=>$id))
				);
				$res=$this->Crud->join($tafsiran)->result();				
				$dtanalisatafsiran=$res;
				$res=$res;
			}
		}
		$tafsiran=array(
			'tabel'=>'taksiran',
			'order'=>array('kolom'=>'taksiran_id','orderby'=>'DESC'),
		);		
		$q_analisapekerjaan=array(
			'tabel'=>'analisapekerjaan',
			'where'=>array(array('analisapekerjaan_idpekerjaan'=>$id)),
		);	

		$r_analisapekerjaan=$this->Crud->read($q_analisapekerjaan)->result();

		
		$detailanalisapekerjaan=array();	
		if($r_analisapekerjaan){
			foreach ($r_analisapekerjaan as $index => $row) {
				$jumlah=0;
				$detailanalisapekerjaan[$index]=$row;
				$q_detailanalisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.hargasatuan_hargasatuan FROM analisadetail a 
				JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
				WHERE a.analisadetail_idanalisapekerjaan=$row->analisapekerjaan_id";
				$r_detailanalisapekerjaan=$this->Crud->hardcode($q_detailanalisapekerjaan)->result();
				$jumlahtotal=0;
				foreach ($r_detailanalisapekerjaan as $index2 => $rows) {
					$jumlah+=intval($rows->analisadetail_koefisien)*intval($rows->hargasatuan_hargasatuan);
					$jumlahtotal=$jumlah;
				}
				$detailanalisapekerjaan[$index]->jumlah=$jumlahtotal;
			}			
		}		
		$data=array(
			'global'=>$global,
			'config'=>$config,
			'datasatuan'=>$dtanalisasatuan,
			'datatafsiran'=>$dtanalisatafsiran,
			'analisapekerjaan2'=>$detailanalisapekerjaan,
			'analisapekerjaan'=>$this->Crud->read($q_analisapekerjaan)->result(),
			'tafsiran'=>$this->Crud->read($tafsiran)->result(),
			'pekerjaan_id'=>$id,
			'res'=>$res,			
		);		
		$cetak=[
			'view'=>$this->load->view($this->default_view.'cetak',$data,true),	
			'judul'=>$global_set['headline'],
		];	
		$this->prosescetak($cetak);			
	}
	public function cetakdetailanalisapekerjaan($id=null){
		$config=$this->atributcetak;
		$global_set=array(
			'headline'=>'laporan analisa pekerjaan',
			'url'=>'analisa2/admin/',
		);
		$global=$this->global_set($global_set);
		if(!$id){
			$id=$this->input->post('id');
		}else{
			$id=$id;
		}
		$analisapekerjaan=array(
			'tabel'=>'analisadetail',
			'where'=>array(array('analisadetail_idanalisapekerjaan'=>$id)),
		);
		// $q_analisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.*,c.kategorisatuan_nama,d.satuan_kode FROM analisadetail a 
		// 	JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
		// 	JOIN kategorisatuan c ON c.kategorisatuan_id=b.hargasatuan_idkategori
		// 	JOIN satuan d ON d.satuan_id=b.hargasatuan_satuan";
		//$r_analisapekerjaan=$this->Crud->hardcode($q_analisapekerjaan)->result();	
		$q_kategorisatuan=[
			'select'=>'kategorisatuan_nama,kategorisatuan_id',
			'tabel'=>'kategorisatuan',
		];
		$r_kategorisatuan=$this->Crud->read($q_kategorisatuan)->result();
		$r_detailanalisapekerjaan=array();
		foreach($r_kategorisatuan AS $index => $row){
			$q_analisapekerjaan="SELECT a.analisadetail_id,a.analisadetail_koefisien,b.*,c.kategorisatuan_nama,d.satuan_kode FROM analisadetail a 
				JOIN hargasatuan b ON b.hargasatuan_id=a.analisadetail_idhargasatuan
				JOIN kategorisatuan c ON c.kategorisatuan_id=b.hargasatuan_idkategori
				JOIN satuan d ON d.satuan_id=b.hargasatuan_satuan
				WHERE c.kategorisatuan_id=$row->kategorisatuan_id AND a.analisadetail_idanalisapekerjaan=$id";
			$r_analisapekerjaan=$this->Crud->hardcode($q_analisapekerjaan)->result();
			if($r_analisapekerjaan){
				$r_detailanalisapekerjaan[$index]=$row;
				$r_detailanalisapekerjaan[$index]->data=$r_analisapekerjaan;					
			}
			
		}
		$pekerjaan=array(
			'tabel'=>'analisapekerjaan',
			'where'=>array(array('analisapekerjaan_id'=>$id)),
		);
		$result=$this->Crud->read($analisapekerjaan)->result();						
		$data=array(
			'global'=>$global,
			'config'=>$config,			
			//'detailanalisapekerjaan'=>$this->Crud->hardcode($q_analisapekerjaan)->result(),
			'detailanalisapekerjaan'=>$r_detailanalisapekerjaan,
			'analisapekerjaan'=>$this->Crud->read($pekerjaan)->row(),
			'analisapekerjaan_id'=>$id,
		);
		$cetak=[
			'view'=>$this->load->view($this->default_view.'cetakdetailanalisapekerjaan',$data,true),	
			'judul'=>$global_set['headline'],
		];	
		$this->prosescetak($cetak);		
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
