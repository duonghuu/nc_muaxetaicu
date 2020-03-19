<?php  if(!defined('_source')) die("Error");
$d->reset();
if(isset($_GET['id'])){
	$d->query("select * from #_gallery where hienthi = 1 and id = ".$_GET['id']);
	$rs_ = $d->fetch_array();		
	$title_bar = $rs_['ten_'.$lang].' - ';		
}else{
$title_bar= _gallery.' - ';		
	
$d->query("select * from #_gallery where hienthi = 1 order by stt");
$result = $d->result_array();	
}
?>