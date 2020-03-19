<?php  if(!defined('_source')) die("Error");
$d->reset();
if(isset($_GET['id'])){
	$d->query("select * from #_gallery where hienthi = 1 and id = ".$_GET['id']);
	$rs_ = $d->fetch_array();		
	
	$title_bar = $rs_['ten_'.$lang].' - ';		
}else{
$title_bar= _fashion_.' - ';		
$title_cat = _fashion_;	
$d->query("select * from #_gallery where hienthi = 1 and type='".$_GET['com']."' order by stt,id desc ");
$result = $d->result_array();	

}
?>