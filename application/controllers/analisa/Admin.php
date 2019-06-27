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
	private $default_url="analisa/admin/";
	private $default_view="analisa/admin/";
	private $view="template/backend";
	private $id="analisa_id";

	private function global_set($data){
		$data=array(
			'menu'=>'analisis',
			'submenu_menu'=>'analisis',
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-bookmark-o",
			'view'=>"views/analisa/admin/index.php",
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
			'url'=>'analisa/admin/',
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
			$data=array(
				'pekerjaan'=>$this->Crud->read($pekerjaan)->result(),
				'global'=>$global,
				'menu'=>$this->menu(),
			);			
			$this->load->view($this->view,$data);
		}	
	}
	public function tabel($id=null){
		$global_set=array(
			'headline'=>'detail analisa',
			'url'=>'analisa/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		if(!$id){
			$id=$this->input->post('id');
		}else{
			$id=$id;
		}
		// $query=array(
		// 	'tabel'=>$this->master_tabel,
		// 	'where'=>array(array('analisa_id'=>$id)),
		// );
		//ANALISA TERDIRI DARI 2 BAGIAN BAGIAN TAFSIRAN DAN SATUAN
		$analisa=array(
			'tabel'=>'analisa',
			'where'=>array(array('analisa_idpekerjaan'=>$id)),
			'order'=>array('kolom'=>'analisa_analisa','orderby'=>'DESC'),
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
		$satuan=array(
			'tabel'=>'hargasatuan',
			'order'=>array('kolom'=>'hargasatuan_id','orderby'=>'DESC'),
			);		
		$data=array(
			'global'=>$global,
			//analisasatuan
			'datasatuan'=>$dtanalisasatuan,
			'datatafsiran'=>$dtanalisatafsiran,
			'satuan'=>$this->Crud->read($satuan)->result(),
			'tafsiran'=>$this->Crud->read($tafsiran)->result(),
			'pekerjaan_id'=>$id,
			'res'=>$res,
		);
		$this->load->view($this->default_view.'tabel',$data);		
		//$this->dump_data($data['res']);
	}
	public function addtafsiran(){
		$global_set=array(
			'headline'=>'add tafsiran',
			'url'=>'analisa/admin/',
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
		if($insert){
			$dt['success']='Simpan tafsiran berhasil';
			$dt['id_pekerjaan']=$data['idpekerjaan'];
		}else{
			$dt['error']='Simpan tafsiran gagal, msg : '.$insert;
		}
		return $this->output ->set_output(json_encode($dt));
		//redirect(base_url($this->default_url));
		//$this->dump_data($dt);
	}
	public function add(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'add analisa',
			'url'=>'analisa/admin/', //AKAN DIREDIRECT KE INDEX
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
			'url'=>'analisa/admin/edit',
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
		}else{
			$dt['error']='Hapus Gagal, Msg '.$delete;
		}
		return $this->output->set_output(json_encode($dt));
		//$this->notifiaksi($delete);
		//redirect(site_url($this->default_url));
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
