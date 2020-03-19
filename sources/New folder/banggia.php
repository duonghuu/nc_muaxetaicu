<?php  if(!defined('_source')) die("Error");
	$d->setTable('banggia');
	$d->select("noidung,photo");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$noidung_about= $row['noidung'];
		$noidung_about2= $row['photo'];
	}
	
	// thanh tieu de
	$title_bar .= "Bảng giá - ";
	$title_cat = "Bảng giá";
?>