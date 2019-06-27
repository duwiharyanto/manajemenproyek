<?php
	class Master extends CI_Controller
	{
		function __construct(){
			parent::__construct();
			$this->load->model('Crud');
		}
		protected function cek_login(){
			if($this->session->userdata('user_login')==true AND $this->session->userdata('user_level')==1 ){
				redirect(site_url('dashboard/admin'));
			}elseif($this->session->userdata('user_login')==true AND $this->session->userdata('user_level')!=1 ){
				redirect(site_url('formulir/user'));
			}			
		}
		protected function cek_admin(){	
			if(($this->session->userdata('user_login')<>1) OR ($this->session->userdata('user_level')<>1)){
				redirect(site_url('login/logout'));
			}					
		}
		protected function notifiaksi($param){
			if($param==1){
				$this->session->set_flashdata('success','proses berhasil');
			}else{
				$this->session->set_flashdata('error',$param);
			}		
		}
		protected function dump_data($data){
			echo '<pre>';
			print_r($data);
		}
		protected function fileupload($path,$file){
			$config=array(
				'upload_path'=>$path,
				'allowed_types'=>'pdf',
				'max_size'=>5000, //5MN
				'encrypt_name'=>true, //ENCTYPT
			);
			$this->load->library('upload',$config);
			return $this->upload->do_upload($file);
		}
		protected function downloadfile($path,$file){
				$link=$path.$file;
				if(file_exists($link)){
					$url=file_get_contents($link);
					force_download($file,$url);
				}else{
					$this->session->set_flashdata('error','File tidak ditemukan');
					//redirect(site_url($this->default_url));	
				}						
		}
		protected function menu(){
			$main_menu=array(
				'tabel'=>'menu',
				'where'=>array(array('menu_is_mainmenu'=>'0'),array('menu_status'=>'1'),array('menu_akses_level'=>$this->userlevel)),
				'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
			);
			$menu_akhir=array();
			$menu=$this->Crud->read($main_menu)->result();
			if(count($menu)>0){
				foreach ($menu as $index => $row) {
					$menu_akhir[$index]=$row;
					$sub_menu=array(
						'tabel'=>'menu',
						'where'=>array(array('menu_is_mainmenu '=>$row->menu_id),array('menu_status'=>'1')),
						'order'=>array('kolom'=>'menu_urutan','orderby'=>'ASC'),
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
		protected function pricetag($price){
			$proses1=str_replace('Rp ', '', $price);
			$finalproses=str_replace('.', '', $proses1);
			return $finalproses;
		}	
		protected function prosescetak($data){
			$nama_dokumen=$data['judul']; //Beri nama file PDF hasil.
			require_once('./asset/mPDF/mpdf.php');
			$mpdf= new mPDF('c','A4-Pa','',0,10,10,30,20);	
			$mpdf->SetHTMLHeader('
			<div style="text-align: center; font-weight: bold;">
			    <img src="'.base_url('asset/dist/img/arraymotion.png').'" width="60px" height="60px">'.ucwords('PT ADHIKARYA').'
			</div>');
			$mpdf->SetTitle(ucwords($data['judul']));
			$mpdf->SetHTMLFooter('
			<table width="100%">
			    <tr>
			        <td width="33%">{DATE j-m-Y}</td>
			        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
			        <td width="33%" style="text-align: right;">'.ucwords('PT. Adhikarya').'</td>
			    </tr>
			</table>');		
			$mpdf->WriteHTML($data['view']);
			$mpdf->Output($nama_dokumen.".pdf",'I');		
		}
		protected function cetaklanscape($data){
			$nama_dokumen=$data['judul']; //Beri nama file PDF hasil.
			require_once('./asset/mPDF/mpdf.php');
			$mpdf= new mPDF('c','A4-L','',0,10,10,30,20);	

			$mpdf->SetHTMLHeader('
			<div style="text-align: center; font-weight: bold;">
			    <img src="'.base_url('asset/dist/img/arraymotion.png').'" width="60px" height="60px">'.ucwords('PT ADHIKARYA').'
			</div>');
			$mpdf->SetTitle(ucwords($data['judul']));
			$mpdf->SetHTMLFooter('
			<table width="100%">
			    <tr>
			        <td width="33%">{DATE j-m-Y}</td>
			        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
			        <td width="33%" style="text-align: right;">'.ucwords('PT. Adhikarya').'</td>
			    </tr>
			</table>');		
			$mpdf->WriteHTML($data['view']);
			$mpdf->Output($nama_dokumen.".pdf",'I');		
		}					
	}
?>