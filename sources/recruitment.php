<?php  if(!defined('_source')) die("Error");
	$id = 148;
	#tin tuc chi tiet
	
	$sql = "select * from #_news where hienthi=1 and loaitin='recruitment' and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->result_array();
	$title_bar=$tintuc_detail[0]['ten_'.$lang].' - ';
	$title_cat=$tintuc_detail[0]['ten_'.$lang];
	
	

?>