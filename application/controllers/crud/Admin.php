<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userid=$this->session->userdata('user_id');
		$this->userlevel=$this->session->userdata('level');
		if(($this->session->userdata('login')!=true) || ($this->session->userdata('level')!=1) ){
			redirect(site_url('login/logout'));
		}
	}
	//VARIABEL
	private $master_tabel="thakademik";
	private $default_url="laporan/admin/";
	private $default_view="laporan/admin/";
	private $view="template/backend";
	private $id="thakademik_id";
	private $path_foto="./upload/foto/";
	private $path_buktibayar="./upload/buktibayar/";

	private function global_set($data){
		$data=array(
			'menu'=>'laporan',
			'submenu_menu'=>false,
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-print",
			'view'=>"views/laporan/admin/index.php",
			'detail'=>false,
			'edit'=>true,
			'delete'=>true,
		);
		return (object)$data;
	}	
	private function notifiaksi($param){
		if($param==1){
			$this->session->set_flashdata('success','proses berhasil');
		}else{
			$this->session->set_flashdata('error',$param);
		}		
	}
	public function fileupload($path,$file){
		$config=array(
			'upload_path'=>$path,
			'allowed_types'=>'pdf',
			'max_size'=>5000, //5MN
			'encrypt_name'=>true, //ENCTYPT
		);
		$this->load->library('upload',$config);
		return $this->upload->do_upload($file);
	}
	public function downloadfile($path,$file){
			$link=$path.$file;
			if(file_exists($link)){
				$url=file_get_contents($link);
				force_download($file,$url);
			}else{
				$this->session->set_flashdata('error','File tidak ditemukan');
				redirect(site_url($this->default_url));	
			}						
	}
	public function menu(){
		$main_menu=array(
			'tabel'=>'menu',
			'where'=>array('menu_is_mainmenu'=>'0'),
			'where_'=>array('menu_status'=>'1'),
			'where__'=>array('menu_akses_level'=>$this->userlevel),
			'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
		);
		$menu_akhir=array();
		$menu=$this->Crud->read($main_menu)->result();
		if(count($menu)>0){
			foreach ($menu as $index => $row) {
				$menu_akhir[$index]=$row;
				$sub_menu=array(
					'tabel'=>'menu',
					'where'=>array('menu_is_mainmenu '=>$row->menu_id),
				);
				$submenu=$this->Crud->read($sub_menu)->result();
				if(count($submenu)>0){
					$menu_akhir[$index]->status=1;
					//$submenu=array();
					$menu_akhir[$index]->submenu=$submenu;
				}else{
					$menu_akhir[$index]->status=0;
					$menu_akhir[$index]->submenu=0;
				}				
			}
		}
		//print_r($menu_akhir);
		return $menu_akhir;		
	}	
	public function prosescetak($data){
		$nama_dokumen=$data['judul']; //Beri nama file PDF hasil.
		require_once('./asset/mPDF/mpdf.php');
		$mpdf= new mPDF('c','A4-Pa','',0,20,20,20,20);	
		// $mpdf->SetHTMLHeader('
		// <div style="text-align: left; font-weight: bold;">
		//     <img src="./asset/dist/img/avatar6.png" width="60px" height="60px">'.$nama_dokumen.'
		// </div>');
		$mpdf->SetHTMLFooter('
		<table width="100%">
		    <tr>
		        <td width="33%">{DATE j-m-Y}</td>
		        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
		        <td width="33%" style="text-align: right;">'.$nama_dokumen.'</td>
		    </tr>
		</table>');		
		$mpdf->WriteHTML($data['view']);
		$mpdf->Output($nama_dokumen.".pdf",'I');		
	}		
	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'laporan',
			'url'=>'laporan/admin/',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$data=array(
				'thakademik_kode'=>$this->input->post('thakademik_kode'),
				'thakademik_status'=>$this->input->post('thakademik_status'),
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
			$query=array(
				'tabel'=>'thakademik',
				'order'=>array('kolom'=>'thakademik_kode','orderby'=>'DESC'),
			);
			$data=array(
				'global'=>$global,
				'thakademik'=>$this->Crud->read($query)->result(),
				'menu'=>$this->menu(),
			);			
			$this->load->view($this->view,$data);
			//print_r($data['menu'][1]->submenu);
		}
	}
	public function tabel(){
		$global_set=array(
			'submenu'=>false,
			'headline'=>'data',
			'url'=>'laporan/admin/',
		);
		$global=$this->global_set($global_set);		
		//PROSES TAMPIL DATA
		$thakademik=$this->input->post('thakademik');
		$query=array(
			'tabel'=>'formulir',
			'where'=>array('formulir_thakademik'=>$thakademik),
			'order'=>array('kolom'=>'formulir_nim','orderby'=>'DESC'),
			);
		$data=array(
			'global'=>$global,
			'data'=>$this->Crud->read($query)->result(),
		);
		//print_r($data['data']);
		$this->load->view($this->default_view.'tabel',$data);		
	}
	// public function add(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'tahun akademiks',
	// 		'url'=>'thakademik/admin/', //AKAN DIREDIRECT KE INDEX
	// 	);
	// 	$admin=array(
	// 		'tabel'=>"admin",
	// 		'order'=>array('kolom'=>'admin_id','orderby'=>'DESC'),
	// 		);		
	// 	$global=$this->global_set($global_set);
	// 	$data=array(
	// 		//'admin'=>$this->Crud->read($admin)->result(),
	// 		'global'=>$global,
	// 		);

	// 	$this->load->view($this->default_view.'add',$data);		
	// }	
	// public function edit(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'edit data',
	// 		'url'=>'thakademik/admin/edit',
	// 	);
	// 	$global=$this->global_set($global_set);
	// 	$id=$this->input->post('id');
	// 	if($this->input->post('submit')){
	// 		$data=array(
	// 			'thakademik_kode'=>$this->input->post('thakademik_kode'),
	// 			'thakademik_status'=>$this->input->post('thakademik_status'),
	// 		);
	// 		// $file='fileupload';
	// 		// if($_FILES[$file]['name']){
	// 		// 	if($this->fileupload($this->path,$file)){
	// 		// 		$file=$this->upload->data('file_name');
	// 		// 		$data['pendaftaran_file']=$file;
	// 		// 		//print_r($data);
	// 		// 	}else{
	// 		// 		$this->session->set_flashdata('error',$this->upload->display_errors());
	// 		// 		redirect(site_url($this->default_url));
	// 		// 	}
	// 		// }			
	// 		$query=array(
	// 			'data'=>$data,
	// 			'where'=>array($this->id=>$id),
	// 			'tabel'=>$this->master_tabel,
	// 			);
	// 		$update=$this->Crud->update($query);
	// 		$this->notifiaksi($update);
	// 		redirect(site_url($this->default_url));
	// 	}else{
	// 		$query=array(
	// 			'tabel'=>$this->master_tabel,
	// 			'where'=>array('thakademik_id'=>$id),
	// 		);
	// 		$admin=array(
	// 			'tabel'=>"admin",
	// 			'order'=>array('kolom'=>'admin_id','orderby'=>'ASC'),
	// 			);			
	// 		$data=array(
	// 			'data'=>$this->Crud->read($query)->row(),
	// 			'global'=>$global,
	// 		);
	// 		//print_r($data['data']);
	// 		$this->load->view($this->default_view.'edit',$data);
	// 	}
	// }	
	// public function detail(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'detail pendaftaran',
	// 		'url'=>'admin/pendaftaran/edit',
	// 	);
	// 	$global=$this->global_set($global_set);		
	// 	$id=$this->input->post('id');
	// 	$query=array(
	// 		'select'=>'a.pendaftaran_id,a.pendaftaran_adminid,a.pendaftaran_tgl,a.pendaftaran_judul,a.pendaftaran_keterangan,a.pendaftaran_file,a.pendaftaran_tersimpan,b.admin_adminname,b.admin_email',
	// 		'tabel'=>'pendaftaran a',
	// 		'join'=>array(array('tabel'=>'admin b','ON'=>'b.admin_id=a.pendaftaran_adminid','jenis'=>'inner')),
	// 		'order'=>array('kolom'=>'a.pendaftaran_id','orderby'=>'ASC'),
	// 		'where'=>array('a.pendaftaran_id'=>$id),
	// 	);
	// 	$data=array(
	// 		'data'=>$this->Crud->join($query)->row(),
	// 		'global'=>$global,
	// 	);
	// 	$this->load->view($this->default_view.'detail',$data);		
	// }
	// public function hapus($id){
	// 	$query=array(
	// 		'tabel'=>$this->master_tabel,
	// 		'where'=>array($this->id=>$id),
	// 	);
	// 	$delete=$this->Crud->delete($query);
	// 	$this->notifiaksi($delete);
	// 	redirect(site_url($this->default_url));
	// }
	public function exportexcel(){
		$thakademik=$this->input->post('thakademik');
		//$thakademik='18.1';
		$query=array(
			'tabel'=>'formulir',
			'where'=>array('formulir_thakademik'=>$thakademik),
			'order'=>array('kolom'=>'formulir_nim','orderby'=>'DESC'),
			);		
		$data=array(
			'nama_file'=>'formulir_wisuda_'.$thakademik,
			'headline'=>'laporan formulir wisuda '.$thakademik,
			'data'=>$this->Crud->read($query)->result(),
		);
		//print_r($data);
		$this->load->view($this->default_view.'export',$data);	
	}
	public function detailformulir($id){
		$query=array(
			'tabel'=>'formulir',
			'where'=>array('md5(formulir_id::text)'=>$id),
		);
		$formulir=$this->Crud->read($query)->row();
		$data=array(
			'view'=>$this->load->view($this->default_view.'/cetak',$formulir,true),
			'judul'=>'Blangko Wisuda',	
		);
		$this->prosescetak($data);		
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
	public function downloadfoto($file){
		$path=$this->path_foto;
		$this->downloadfile($path,$file);
	}
	public function downloadbuktibayar($file){
		$path=$this->path_buktibayar;
		$this->downloadfile($path,$file);
	}		
}
