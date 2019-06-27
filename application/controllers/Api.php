<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'controllers/master.php';
class Api extends Master {
	public function __construct(){
		parent::__construct();
		$this->load->model('Crud');
		$this->userid=$this->session->userdata('user_id');
		$this->userlevel=$this->session->userdata('user_level');
		// if(($this->session->userdata('user_login')<>1) OR ($this->session->userdata('user_level')<>1)){
		// 	redirect(site_url('login/logout'));
		// }
	}	
	private $key="admin";

	public function index(){
		echo "<a href='".base_url('api/taksiran/'.$this->key)."'>Taksiran</a>";
	}	
	public function taksiran($key=null){
		$query=array(
			'select'=>'a.*,b.satuan_kode',
			'tabel'=>'taksiran a',
			'join'=>array(array('tabel'=>'satuan b','ON'=>'b.satuan_id=a.taksiran_satuan','jenis'=>'INNER'),),
			'order'=>array('kolom'=>'a.taksiran_id','orderby'=>'DESC'),
			);
		$data=array(
			'data'=>$this->Crud->join($query)->result(),
		);	
		if($key=='admin'){
			$json=json_encode(array('data'=>$data['data']));
		}else{
			$json='key no found';	
		}
		print_r($json);
	}
	public function get_taksiran(){
		$url=file_get_contents(base_url('api/taksiran/'.$this->key));
		$data=json_decode($url);
		if(is_array($data->data)){
			foreach ($data->data as $row) {
				echo $row->taksiran_uraian.'<br>';
			}
		}else{
			print_r($url);	
		}
	}
	public function downloadberkas($file){
		$path=$this->path;
		$this->downloadfile($path,$file);
	}
}
