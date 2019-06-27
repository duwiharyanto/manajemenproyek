<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userid=$this->session->userdata('user_id');
		$this->usernim=$this->session->userdata('nim');
		$this->userlevel=$this->session->userdata('level');		
		// if(($this->session->userdata('login')!=true) || ($this->session->userdata('level')!=1) ){
		// 	redirect(site_url('login/logout'));
		// }
	}
	//VARIABEL
	private $master_tabel="formulir";
	private $default_url="formulir/user";
	private $default_view="formulir/user";
	private $view="template/frontend";
	private $id="formulir_id";
	private $pathblangko='./blangko/';
	private $path_foto='./upload/foto/';
	private $path_pembayaran='./upload/buktibayar/';

	private function global_set($data){
		$data=array(
			'menu'=>'formulir',
			'submenu'=>$data['submenu'],
			'headline'=>$data['headline'],
			'url'=>$data['url'],
			'ikon'=>"fa fa-file",
			'view'=>"views/formulir/user/index.php",
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
			'allowed_types'=>'JPG|jpeg|jpg',
			'max_size'=>5000, //5MN
			'encrypt_name'=>true, //ENCTYPT
		);
		$this->load->library('upload',$config,$file);
		return $this->$file->do_upload($file);
	}
	public function downloadfile($path,$file){
			$link=$path.$file;
			if(file_exists($link)){
				$url=file_get_contents($link);
				force_download($file,$url);
			}else{
				$this->session->set_flashdata('error','File tidak ditemukan');
				//redirect(site_url($this->default_url));	
			}						
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

	public function index()
	{
		$global_set=array(
			'submenu'=>false,
			'headline'=>'pendaftaran wisuda',
			'url'=>'formulir/user',
		);
				
		$global=$this->global_set($global_set);
		if($this->input->post('submit')){
			//PROSES SIMPAN
			$foto='filefoto';
			if($_FILES[$foto]['name']){
				if($this->fileupload($this->path_foto,$foto)){
					$datafoto=$this->$foto->data('file_name');
					$uploadfoto=$datafoto;
					//print_r($data);
				}else{
					$this->session->set_flashdata('error',$this->$foto->display_errors());
					redirect(site_url($this->default_url));
				}
			}
			$berkaspembayaran='filepembayaran';
			if($_FILES[$berkaspembayaran]['name']){
				if($this->fileupload($this->path_pembayaran,$berkaspembayaran)){
					$databerkaspembayaran=$this->$berkaspembayaran->data('file_name');
					$uploadbuktibayar=$databerkaspembayaran;
					//print_r($data);
				}else{
					$this->session->set_flashdata('error',$this->$berkaspembayaran->display_errors());
					redirect(site_url($this->default_url));
				}
			}	
			$formulir=array(
				'formulir_nama'=>$this->input->post('formulir_nama'),
				'formulir_jurusan'=>$this->input->post('formulir_jurusan'),
				// 'formulir_programstudi'=>$this->input->post('formulir_programstudi'),
				// 'formulir_fakultas'=>$this->input->post('formulir_fakultas'),
				'formulir_agama'=>$this->input->post('formulir_agama'),
				'formulir_tahunmasuk'=>$this->input->post('formulir_tahunmasuk'),
				'formulir_tahunlulus'=>$this->input->post('formulir_tahunlulus'),
				'formulir_ipk'=>$this->input->post('formulir_ipk'),
				'formulir_judulskripsi'=>$this->input->post('formulir_judulskripsi'),
				'formulir_alamatyogya'=>$this->input->post('formulir_alamatyogya'),
				'formulir_dosbim1'=>$this->input->post('formulir_dosbim1'),
				'formulir_dosbim2'=>$this->input->post('formulir_dosbim2'),
				'formulir_namaorangtua'=>$this->input->post('formulir_namaorangtua'),
				'formulir_alamatasal'=>$this->input->post('formulir_alamatasal'),
				'formulir_email'=>$this->input->post('formulir_email'),
				'formulir_notelp'=>$this->input->post('formulir_notelp'),
				'formulir_perusahaan'=>$this->input->post('formulir_perusahaan'),
				'formulir_alamatkantor'=>$this->input->post('formulir_alamatkantor'),
				'formulir_foto'=>$uploadfoto,
				'formulir_buktibayar'=>$uploadbuktibayar,
				'formulir_thakademik'=>$this->input->post('formulir_thakademik'),
				'formulir_tgllahir'=>date('Y-m-d',strtotime($this->input->post('formulir_tgllahir'))),
				'formulir_nim'=>$this->input->post('formulir_nim'),
				'formulir_tempatlahir'=>$this->input->post('formulir_tempatlahir'),
			);					
			$query=array(
				'data'=>$formulir,
				'tabel'=>$this->master_tabel,
			);
			// //VALIDASI SIMPAN, JIKA DI DATABASE ADA NIM TSB TIDAK AKAN DISIMPAN
			// $nim=$formulir['formulir_nim'];
			// $cek_nim=$this->db->query("SELECT formulir_id FROM formulir WHERE formulir_nim='$nim'")->result();
			// if(count($cek_nim)<>0){
			// 	$this->session->set_flashdata('error','Anda sudah mengirim formulir sebelumnya, silahkan mencetak formulir');
			// }else{
			// 	$insert=$this->Crud->insert($query);
			// 	$this->notifiaksi($insert);				
			// }
			$insert=$this->Crud->insert($query);
			$this->notifiaksi($insert);				
			redirect(site_url($this->default_url));
			// print_r($data['menu']);
		}else{
			$cek_nim=$this->db->query("SELECT formulir_id FROM formulir WHERE formulir_nim='$this->usernim'")->result();
			$thakademik=array(
				'tabel'=>'thakademik',
				'where'=>array('thakademik_status'=>'1'),
				'order'=>array('kolom'=>'thakademik_kode','orderby'=>'DESC'),
				'limit'=>1,
			);
			$prodi=array(
				'tabel'=>'prodi',
				'where'=>array('aktif'=>'1'),
				'order'=>array('kolom'=>'kode','orderby'=>'ASC'),
			);	
			$agama=array(
				'tabel'=>'agama',
				'order'=>array('kolom'=>'agamaid','orderby'=>'ASC'),
			);	
			$dosen=$this->db->query("SELECT * FROM dosen WHERE aktif is null ORDER BY kode ASC")->result();										
			$data=array(
				'global'=>$global,
				'menu'=>$this->menu(),
				'thakademik'=>$this->Crud->read($thakademik)->row(),
				'prodi'=>$this->Crud->read($prodi)->result(),
				'agama'=>$this->Crud->read($agama)->result(),
				'dosen'=>$dosen,
				'cek_nim'=>$cek_nim,
			);	
			//CEK HALAMAN, JIKA DIDATABASE ADA MAKA DI ARAHKAN KE HALAMAN EDIT
			if(count($cek_nim)<>0){
				$formulir=array(
					'tabel'=>'formulir',
					'where'=>array('formulir_nim'=>$this->usernim),
					'limit'=>1,
				);
				$dformulir=$this->Crud->read($formulir)->row();
				$data['formulir']=$dformulir;
			}				
			$this->load->view($this->view,$data);
			//print_r($data['dosen']);
		}
	}	
	public function update(){
		$formulir_id=$this->input->post('id');
		$formulir=array(
			'formulir_nama'=>$this->input->post('formulir_nama'),
			'formulir_jurusan'=>$this->input->post('formulir_jurusan'),
			// 'formulir_programstudi'=>$this->input->post('formulir_programstudi'),
			// 'formulir_fakultas'=>$this->input->post('formulir_fakultas'),
			'formulir_agama'=>$this->input->post('formulir_agama'),
			'formulir_tahunmasuk'=>$this->input->post('formulir_tahunmasuk'),
			'formulir_tahunlulus'=>$this->input->post('formulir_tahunlulus'),
			'formulir_ipk'=>$this->input->post('formulir_ipk'),
			'formulir_judulskripsi'=>$this->input->post('formulir_judulskripsi'),
			'formulir_alamatyogya'=>$this->input->post('formulir_alamatyogya'),
			'formulir_dosbim1'=>$this->input->post('formulir_dosbim1'),
			'formulir_dosbim2'=>$this->input->post('formulir_dosbim2'),
			'formulir_namaorangtua'=>$this->input->post('formulir_namaorangtua'),
			'formulir_alamatasal'=>$this->input->post('formulir_alamatasal'),
			'formulir_email'=>$this->input->post('formulir_email'),
			'formulir_notelp'=>$this->input->post('formulir_notelp'),
			'formulir_perusahaan'=>$this->input->post('formulir_perusahaan'),
			'formulir_alamatkantor'=>$this->input->post('formulir_alamatkantor'),
			'formulir_thakademik'=>$this->input->post('formulir_thakademik'),
			'formulir_tgllahir'=>date('Y-m-d',strtotime($this->input->post('formulir_tgllahir'))),
			'formulir_nim'=>$this->input->post('formulir_nim'),
			'formulir_tempatlahir'=>$this->input->post('formulir_tempatlahir'),
		);	
		$foto='filefoto';
		if($_FILES[$foto]['name']){
			if($this->fileupload($this->path_foto,$foto)){
				$datafoto=$this->$foto->data('file_name');
				$formulir['formulir_foto']=$datafoto;
				//print_r($data);
			}else{
				$this->session->set_flashdata('error',$this->$foto->display_errors());
				redirect(site_url($this->default_url));
			}
		}
		$berkaspembayaran='filepembayaran';
		if($_FILES[$berkaspembayaran]['name']){
			if($this->fileupload($this->path_pembayaran,$berkaspembayaran)){
				$databerkaspembayaran=$this->$berkaspembayaran->data('file_name');
				$formulir['formulir_buktibayar']=$databerkaspembayaran;
				//print_r($data);
			}else{
				$this->session->set_flashdata('error',$this->$berkaspembayaran->display_errors());
				redirect(site_url($this->default_url));
			}
		}
		$query=array(
			'data'=>$formulir,
			'where'=>array($this->id=>$formulir_id),
			'tabel'=>$this->master_tabel,
		);		
		//echo $formulir_id;
		$update=$this->Crud->update($query);
		$this->notifiaksi($update);	
		redirect(site_url($this->default_url));							
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
			'select'=>'a.pendaftaran_id,a.pendaftaran_userid,a.pendaftaran_tgl,a.pendaftaran_judul,a.pendaftaran_keterangan,a.pendaftaran_file,a.pendaftaran_tersimpan,b.user_username,b.user_email',
			'tabel'=>'pendaftaran a',
			'join'=>array(array('tabel'=>'user b','ON'=>'b.user_id=a.pendaftaran_userid','jenis'=>'inner')),
			'order'=>array('kolom'=>'a.pendaftaran_id','orderby'=>'ASC'),
			'where'=>array('a.pendaftaran_id'=>$id),
		);
		$data=array(
			'data'=>$this->Crud->join($query)->row(),
			'global'=>$global,
		);
		$this->load->view($this->default_view.'detail',$data);		
	}
	public function cetakblangko(){
		//echo "dwadwa";
		$query=array(
			'tabel'=>'formulir',
			'where'=>array('formulir_nim'=>$this->usernim),
		);
		$formulir=$this->Crud->read($query)->row();
		$data=array(
			'view'=>$this->load->view($this->default_view.'/cetak',$formulir,true),
			'judul'=>'Blangko Wisuda',	
		);
		$this->prosescetak($data);
	}	
	public function downloadblangko(){
		$file="blankowisuda18.pdf";
		$path=$this->pathblangko;
		$this->downloadfile($path,$file);
	}
	// public function tabel(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'data',
	// 		'url'=>'formulir/user',
	// 	);
	// 	$global=$this->global_set($global_set);		
	// 	//PROSES TAMPIL DATA
	// 	$query=array(
	// 		'tabel'=>$this->master_tabel,
	// 		'order'=>array('kolom'=>'id','orderby'=>'DESC'),
	// 		);
	// 	$data=array(
	// 		'global'=>$global,
	// 		'data'=>$this->Crud->read($query)->result(),
	// 	);
	// 	$this->load->view($this->default_view.'tabel',$data);		
	// }
	// public function add(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'crud',
	// 		'url'=>'formulir/user', //AKAN DIREDIRECT KE INDEX
	// 	);
	// 	$user=array(
	// 		'tabel'=>"user",
	// 		'order'=>array('kolom'=>'user_id','orderby'=>'DESC'),
	// 		);		
	// 	$global=$this->global_set($global_set);
	// 	$data=array(
	// 		'global'=>$global,
	// 		);

	// 	$this->load->view($this->default_view.'add',$data);		
	// }	
	// public function edit(){
	// 	$global_set=array(
	// 		'submenu'=>false,
	// 		'headline'=>'edit data',
	// 		'url'=>'formulir/useredit',
	// 	);
	// 	$global=$this->global_set($global_set);
	// 	$id=$this->input->post('id');
	// 	if($this->input->post('submit')){
	// 		$data=array(
	// 			'nama'=>$this->input->post('nama'),
	// 			'tgllahir'=>date('Y-m-d',strtotime($this->input->post('tgllahir'))),
	// 			'nomerhp'=>$this->input->post('nomerhp'),
	// 			'desa'=>$this->input->post('desa'),
	// 			//'pendaftaran_tersimpan'=>date('Y-m-d')
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
	// 			'where'=>array('id'=>$id),
	// 		);
	// 		$user=array(
	// 			'tabel'=>"user",
	// 			'order'=>array('kolom'=>'user_id','orderby'=>'ASC'),
	// 			);			
	// 		$data=array(
	// 			'data'=>$this->Crud->read($query)->row(),
	// 			'global'=>$global,
	// 		);
	// 		//print_r($data['data']);
	// 		$this->load->view($this->default_view.'edit',$data);
	// 	}
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
}
