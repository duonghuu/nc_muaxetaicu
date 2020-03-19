<?php  if(!defined('_source')) die("Error");
if(isset($_GET['id'])){
	$d->query("select * from #_admission where hienthi = 1 and id = ".$_GET['id']);
	$rs = $d->fetch_array();
	forceDownload(_upload_file_l.$rs['url']);
	exit();	
}
	$title_bar=_admission.' - ';		

	$d->query("select * from #_admission where hienthi = 1 order by stt");
	$result = $d->result_array();	
	
	function forceDownload($file){

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		
	}
?>