<?php

	class Login extends CI_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->model('Crud');
		}
		private $master_tabel='user';
		private $id='user_id';

		function index($param=null){
			if($this->session->userdata('user_login')==true AND $this->session->userdata('user_level')==1 ){
				redirect(site_url('hargasatuan/admin'));
			}elseif($this->session->userdata('user_login')==true AND $this->session->userdata('user_level')!=1 ){
				redirect(site_url('formulir/user'));
			}
			//CEK ILEGAL AKSES BY USER
			if($param=='1'){
				$data['param']='1';
			}else{
				$data['param']=false;
			}
			$this->load->view('template/login',$data);
		}
		function aksi_login(){
			$username=$this->input->post('username');
			//$password=md5($this->input->post('password'));
			$password=$this->input->post('password');
			$query=array(
				'tabel'=>$this->master_tabel,
				'where'=>array(array('user_username'=>$username),array('user_password'=>$password)),
				//'or_where'=>array('user_email'=>$username)
			);
			$cek_user=$this->Crud->read($query);
			if($cek_user->num_rows()==1){
				$user=$cek_user->row();
				$dt_session=array(
						'user_id'=>$user->user_id,
						'user_nama'=>$user->user_nama,
						'user_username'=>$user->user_username,
						'user_level'=>$user->user_level,
						'user_tersimpan'=>$user->user_tersimpan,
						'user_login'=>true,
						);
				$this->session->set_userdata($dt_session);				
				if($this->session->userdata('user_level')==1){
					//echo "login";
				 	redirect(site_url("hargasatuan/admin"));
				 	//print_r($this->session->userdata());
				 	//if(($this->session->userdata('user_login')<>1) || ($this->session->userdata('user_level')<>1)){
				 	// if(($this->session->userdata('user_login')<>1) OR ($this->session->userdata('user_level')<>1) ){
				 	// 	echo "login";
				 	// }else{
				 	// 	echo "logout";
				 	// }		 	
				}else{
					//echo "login";
					//redirect(site_url("formulir/user"));	
				}
			}else{
				$this->session->set_flashdata('error','username tidak ditemukan');
				redirect(base_url('Login'));
			}
		}
		function logout(){
			$this->session->sess_destroy();			
			redirect(base_url('Login'));
		}	
		function notfound(){
			$this->session->sess_destroy();	
			$param='1';		
			//echo $param;
			$this->index($param);
		}	
	}
?>