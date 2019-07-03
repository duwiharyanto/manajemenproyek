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
	function duit2($jumlah){
		return "Rp " . number_format($jumlah,2,',','.');		
	}
	function desimal($data,$var){
		$cek=str_replace(',', '.', $data);
		$str='%.'.$var.'f';
		return $cek=sprintf($str,$cek);	
	}
?>

