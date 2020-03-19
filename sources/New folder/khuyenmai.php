<?php  if(!defined('_source')) die("Error");
	$d->setTable('khuyenmai');
	$d->select("noidung");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$noidung_about= $row['noidung'];
	}
	
	// thanh tieu de
	$title_bar .= "Khuyến mãi - ";
?>