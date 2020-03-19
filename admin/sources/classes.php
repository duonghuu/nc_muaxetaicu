<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "classes/item_add";
		break;
	case "save":
		save_gioithieu();
		break;

		
	default:
		$template = "index";
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_classes limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d;
	
	
	$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
	$data['noidung_en'] = magic_quote($_POST['noidung_en']);
	$d->reset();
	$d->setTable('classes');
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", "index.php?com=classes&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=classes&act=capnhat");
}

?>