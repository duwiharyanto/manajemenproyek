<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'controllers/master.php';
	class Login extends Master
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
				$logdata=[
					'userid'=>$dt_session['user_id'],
					'loglist'=>1,
				];
				$log=$this->log($logdata);
				if($log){
					if($this->session->userdata('user_level')==1){
					 	redirect(site_url("hargasatuan/admin"));		 	
					}else{
					}
				}else{
					$this->session->set_flashdata('error','log error');
					redirect(base_url('Login'));					
				}				
			}else{
				$this->session->set_flashdata('error','username tidak ditemukan');
				redirect(base_url('Login'));
			}
		}
		function logout(){
			$logdata=[
				'userid'=>$this->session->userdata('user_id'),
				'loglist'=>2,
			];
			$log=$this->log($logdata);			
			if($log){
				$this->session->sess_destroy();			
				redirect(base_url('Login'));
			}else{
				$this->session->set_flashdata('error','log error');
				redirect(base_url('Login'));
			}
		}	
		function notfound(){
			$this->session->sess_destroy();	
			$param='1';		
			//echo $param;
			$this->index($param);
		}	
	}
?>