<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/master.php';
class Addon extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');	
		$this->cek_admin();
	}
	//VARIABEL
	private $default_url="addon/";
	private $default_view="addon/";
	private $view="template/frontend";
		
	public function select_satuan(){
		$query=array(
			'tabel'=>'satuan',
			'order'=>array('kolom'=>'satuan_satuan','orderby'=>'ASC')
		);
		$data=array(
			'data'=>$this->Crud->read($query)->result(),
		);
		$this->load->view($this->default_view.'select_satuan',$data);
		//$this->dump_data($data['data']);
	}
	public function edit_select_satuan($param){
		$query=array(
			'tabel'=>'satuan',
			'order'=>array('kolom'=>'satuan_satuan','orderby'=>'ASC')
		);
		$data=array(
			'data'=>$this->Crud->read($query)->result(),
			'tafsiran_satuan'=>$param,
		);
		$this->load->view($this->default_view.'edit_select_satuan',$data);
		//$this->dump_data($data['data']);
	}		
}
