<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
@define("_table","work");
switch($act){
	case "rss":
		initAddRss();
		
		$template = "work/item_add_rss";
		break;
	case "man":
		get_items();
		
		$template = "work/items";
		break;
	case "add":
		initAdd();
		$template = "work/item_add";
		break;
	case "edit":	
		initAdd();		
		get_item();	
		$template = "work/item_add";
		
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "work/danhmucs";
		break;
	case "add_danhmuc":
		initAdd("work_danhmuc");
		$template = "work/danhmuc_add";
		break;
	case "edit_danhmuc":
		get_danhmuc();
		$template = "work/danhmuc_add";
		break;
	case "save_danhmuc":
		
		
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "work/lists";
		break;
	case "add_list":
		initAdd("work_list");
		$template = "work/list_add";
		break;
	case "edit_list":
		get_list();
		$template = "work/list_add";
		break;
	case "save_list":
		
		
		save_list();
		break;
	case "delete_list":
		delete_list();
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


function get_items(){
	global $d, $items, $paging;
	
	if(@$_REQUEST['update']!='')
	{
	$id_up = @$_REQUEST['update'];
	
	$tinnoibat=time();
	
	$sql_sp = "SELECT id,tinnoibat FROM table_work where id='".$id_up."' ";
	$d->query($sql_sp);
	$danhmucs= $d->result_array();
	$spdc1=$danhmucs[0]['tinnoibat'];
	//echo "id:". $spdc1;
	if($spdc1==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_work SET tinnoibat ='".$tinnoibat."' WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_work SET tinnoibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = @$_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_work where id='".$id_up."' ";
	$d->query($sql_sp);
	$danhmucs= $d->result_array();
	$hienthi=$danhmucs[0]['hienthi'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_work SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_work SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
		if(@$_REQUEST['noibat']!='')
	{
	$id_up = @$_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_work where id='".$id_up."' ";
	$d->query($sql_sp);
	$danhmucs= $d->result_array();
	$hienthi=$danhmucs[0]['noibat'];
	//echo "id:". $spdc1;
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_work SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_work SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

	}	
	}
	$sql = "select * from #_work";
	if((int)$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where  	idlt=".$_REQUEST['id_danhmuc']."";
	}
	$sql.=" order by id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	
	$sql = "select * from #_work where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,8);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	$data['id_danhmuc'] = $_POST['id_danhmuc'];
	$data['id_list'] = $_POST['id_list'];
	
	
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	initSeo($data);
	if($id){
		$id =  themdau($_POST['id']);
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_tintuc,$file_name,3);
			
			$d->setTable('work');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				delete_file(_upload_tintuc.$row['thumb1']);
			}
		}
		
		$data['ngaysua'] = time();
	
		$d->setTable('work');
		$d->setWhere('id', $id);
		if($d->update($data)){
				if($_GET['com']=='about'){
						transfer("Cập nhật thành công", "index.php");
				}
				redirect("index.php?com=".$_GET['com']."&act=man");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}else{
		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400, 300, _upload_tintuc,$file_name);
			
		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('work');
		if($d->insert($data)){
			if($_GET['com'] == 'about'){
				transfer("Cập nhật thành công", "index.php");
				}else{
				redirect("index.php?com=".$_GET['com']."&act=man");
			}
			}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_work where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				delete_file(_upload_tintuc.$row['thumb1']);
			}
			$sql = "delete from #_work where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=".$_GET['com']."&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_work where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				//delete_file(_upload_tintuc.$row['thumb1']);
			}
			$sql = "delete from #_work where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=".$_GET['com']."&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man");
}
//===========================================================
function get_danhmucs(){
	global $d, $items, $paging;
	$sql = "select * from #_work_danhmuc order by stt";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man_danhmuc";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	
	$sql = "select * from #_work_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	$item = $d->fetch_array();
}

function save_danhmuc(){
	global $d,$config;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		//$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		//$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	if($data['tenkhongdau']){
		$file_name = $data['tenkhongdau']."_".time();
	}
	$data['stt'] = $_POST['stt'];		
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){	
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 500,500, _upload_tintuc,$file_name,3);
			
			$d->setTable('work_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
				delete_file(_upload_tintuc.$row['thumb1']);
			}
		}
		$data['ngaysua'] =time();	
		$d->setTable('work_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=".$_GET['com']."&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 500, 500, _upload_tintuc,$file_name);
			
		}
		$data['ngaytao'] =time();	
		$d->setTable('work_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=".$_GET['com']."&act=man_danhmuc");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_work_danhmuc where id='".$id."'";
		if($d->query($sql)){
			$d->query("select * from #_work where id_danhmuc = ".$id);
			foreach($d->result_array() as $k=>$v){
				delete_file(_upload_tintuc.$v['photo']);
				delete_file(_upload_tintuc.$v['thumb']);
				$d->query("delete from #_work where id=".$v['id']);
			}
			redirect("index.php?com=".$_GET['com']."&act=man_danhmuc");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_danhmuc");
	}else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_danhmuc");
}

/*********************************************/
//===========================================================
function get_lists(){
	global $d, $items, $paging;
	$sql = "select * from #_work_list order by stt";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=".$_GET['com']."&act=man_list";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_list(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_list");
	
	$sql = "select * from #_work_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=".$_GET['com']."&act=man_list");
	$item = $d->fetch_array();
}

function save_list(){
	global $d,$config;
	$file_name_item=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_list");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = $_POST['ten_'.$v];
		//$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		//$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}
	$data['stt'] = $_POST['stt'];		
	$data['id_danhmuc'] = $_POST['id_danhmuc'];		
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	if($id){	
		$data['ngaysua'] =time();	
		$d->setTable('work_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=".$_GET['com']."&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_list");
	}else{
		$data['ngaytao'] =time();	
		$d->setTable('work_list');
		if($d->insert($data))
			redirect("index.php?com=".$_GET['com']."&act=man_list");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_list");
	}
}

function delete_list(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_work_list where id='".$id."'";
		if($d->query($sql)){
			$d->query("select * from #_work where id_list = ".$id);
			foreach($d->result_array() as $k=>$v){
				delete_file(_upload_tintuc.$v['photo']);
				delete_file(_upload_tintuc.$v['thumb']);
				$d->query("delete from #_work where id=".$v['id']);
			}
			redirect("index.php?com=".$_GET['com']."&act=man_list");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=".$_GET['com']."&act=man_list");
	}else transfer("Không nhận được dữ liệu", "index.php?com=".$_GET['com']."&act=man_list");
}


?>