<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	#tin tuc chi tiet
	$id =  addslashes($_GET['id']);
	$sql = "select * from #_news where hienthi=1 and loaitin='school' and id='".$id."'";
	$d->query($sql);
	$tintuc_detail = $d->result_array();
	$title_bar=$tintuc_detail[0]['ten_'.$lang].' - ';
	$title_cat=$tintuc_detail[0]['ten_'.$lang];
	
	#các tin cu hon
	$sql_khac = "select * from #_news where hienthi=1 and loaitin='school' and id <'".$id."' order by stt,ngaytao desc limit 0,8";
	$d->query($sql_khac);
	$more = _more_school_info;
	
	$tintuc_khac = $d->result_array();
	
}else{
	$title_cat = _school_info;	
	$title_bar = $title_cat." - ";
	$sql_tintuc = "select * from #_news where hienthi=1 and loaitin='school' order by stt,ngaytao desc";
	$d->query($sql_tintuc);
	$tintuc = $d->result_array();
	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=5;
	$maxP=5;
	$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
	$tintuc=$paging['source'];
}
?>