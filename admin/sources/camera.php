<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "camera/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_camera limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=title&act=capnhat");
	
	$data['password'] = $_POST['password'];
	$ar = array();
	foreach($_POST['links'] as $k=>$v){
		if($v){
			$ar[]  =$v;
		}
	}
	$data['link'] = json_encode($ar);
	$d->reset();
	$d->setWhere("id",1);
	$d->setTable('camera');
	if($d->update($data))
		header("Location:index.php?com=camera&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=camera&act=capnhat");
}

?>