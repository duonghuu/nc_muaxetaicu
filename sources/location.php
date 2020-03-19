
<?php  if(!defined('_source')) die("Error");
	$d->setTable('news');
	$d->setWhere("id",30);
	$d->select("*");
	if($d->num_rows()>0){
		$row = $d->fetch_array();
		$noidung_about= $row['noidung_'.$lang];
	}
	
	// thanh tieu de
	$title_bar = _location_." - ";
	
?>