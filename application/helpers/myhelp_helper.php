<?php
	
	
	function viewdata($data){	
		echo "<pre>";
		print_r($data);
	}
	function backend($view){
		$backend="template/backend";
		$CI =& get_instance();  
		$CI->load->view($backend);
	}
	function duit($jumlah){
		return "Rp " . number_format($jumlah,0,',','.');
	}
?>

