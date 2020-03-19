<?php  if(!defined('_source')) die("Error");
	$is_view = false;
	if(isset($_POST['submit'])){
		
		$p = $_POST['password'];
		$sql = "select * from #_camera where password = '".$p."'";
		$d->query($sql);
		if($d->num_rows() == 1){
			$_SESSION['password_camera'] = 1;
		}
	}
	if(isset($_SESSION['password_camera'])){
		$is_view  = true;
		$d->reset();
		$sql = "select * from #_camera where id = 1";
		$d->query($sql);
		$result = $d->fetch_array();
	}
?>