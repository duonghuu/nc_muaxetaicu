<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
		get_items();
		$template = "social/items";
		break;
	case "add":
		$template = "social/item_add";
		break;
	case "edit":
		get_item();
		$template = "social/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	default:
		$template = "index";
}


function get_items(){
	global $d, $items, $paging;
	
	$sql = "select * from #_social order by stt,ten";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=social&act=man";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=social&act=man");
	
	$sql = "select * from #_social where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=social&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	$file_name = md5(time());
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=social&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		$data['ten'] = $_POST['ten'];
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('social');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);
				
			}
		}
		$data['link'] = $_POST['link'];
		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		
		$d->setTable('social');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:index.php?com=social&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=social&act=man");
	}else{ // them moi
		$data['ten'] = $_POST['ten'];
		
		$data['link'] = $_POST['social'];
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
		}
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		
		$d->setTable('social');
		if($d->insert($data))
			header("Location:index.php?com=social&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=social&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		// xoa item
		$sql = "delete from #_social where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=social&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=social&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=social&act=man");
}
#--------------------------------------------------------------------------------------------- photo

?>

	
