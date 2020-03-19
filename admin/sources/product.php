<?php	if(!defined('_source')) die("Error");
global $lang;
@define('_table','product');
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id=@$_REQUEST['id'];
switch($act){

	case "number":
		capnhatsoluong();
		$template = "product/soluong";
		break;
	case "man":
		get_items();
		$template = "product/items";
		break;	
	case "add":		
		initAdd();
		$template = "product/item_add";
		break;
	case "edit":	
		initAdd();	
		get_item();		
		$template = "product/item_add";
		break;
	case "save":
	

		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_item":
		get_loais();
		$template = "product/loais";
		break;
	case "add_item":		
		$template = "product/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "product/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	#===================================================	
	case "man_cat":
		get_cats();
		$template = "product/cats";
		break;
	case "add_cat":		
		initAdd("product_cat");
		$template = "product/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		initAdd("product_cat");
		$template = "product/cat_add";
		break;
	case "chuyencap_cat":				
		$template = "product/cat_chuyencap";
		break;
	case "save_chuyencap_cat":				
		chuyencap_cat();
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "product/lists";
		break;
	case "add_list":	
		initAdd("product_list");
		$template = "product/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "product/list_add";
		break;
	case "chuyencap_list":		
		$template = "product/list_chuyencap";
		break;
	case "save_chuyencap_list":		
		chuyencap_list();
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
	default:
		$template = "index";
		
		#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "product/danhmucs";
		break;
	case "add_danhmuc":		
		initAdd("product_danhmuc");
		$template = "product/danhmuc_add";
		break;
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "product/danhmuc_add";
		break;
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;
	default:
		$template = "index";
}

#====================================
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
	
	$sql = "select * from #_product";	
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".(int)$_REQUEST['id_list']."";
	}
	if((int)@$_REQUEST['id_cat']!='')
	{
	$sql.=" and id_cat=".(int)$_REQUEST['id_cat']."";
	}
	if(@$_REQUEST['keyword']!='')
	{
	$sql.=" and (ten_vi like '%".$_REQUEST['keyword']."%' or ten_en like '%".$_REQUEST['keyword']."%' or maso like '%".$_REQUEST['keyword']."%')";
	}
	//$sql.=" order by id_danhmuc,id_list,id_cat,id_item,stt desc";
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man&id_danhmuc=".@$_GET['id_danhmuc']."&id_list=".@$_GET['id_list']."&id_cat=".@$_GET['id_cat']."&id_item=".@$_GET['id_item']."&keyword=".@$_GET['keyword'];
	$maxR=20;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}
function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man");
	
	$sql = "select * from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man");
	$item = $d->fetch_array();	
}

function save_item(){
	
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,6);
	$data = array();
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man");
	$photos = array();
	foreach($_POST['photos'] as $k=>$v){
		if($v){
			$photos[] = $v;
		}
	
	}
	$data['gallery'] = json_encode($photos);
	/*$options = array();
	foreach($_POST['options'] as $k=>$v){
		if($v){
			$options[] = $v;
		}
	
	}
	$data['options'] = json_encode($options);
*/
	

	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['id_loaiphong'] = (int)$_POST['id_loaiphong'];
	$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
	$data['chatlieu'] = $_POST['chatlieu'];
	$data['id_list'] = (int)$_POST['id_list'];	
	$data['id_cat'] = (int)$_POST['id_cat'];	
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = magic_quote($_POST['ten_'.$v]);
	
		$data['noidung_'.$v] = magic_quote($_POST['noidung_'.$v]);			
		$data['mota_'.$v] = magic_quote($_POST['mota_'.$v]);
		$data['motangan_'.$v] = magic_quote($_POST['motangan_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);	
		}
	}

	$data['maso'] = $_POST['maso'];			
	$data['gia'] = str_replace(".","",$_POST['gia']);
	$data['gia'] = $_POST['gia'];
	$data['giacu'] =  str_replace(".","",$_POST['giacu']);
	$data['giacu'] =  $_POST['giacu'];
	$data['kichthuoc'] = $_POST['kichthuoc'];

	$data['stt'] = $_POST['stt'];
	$data['hot'] = isset($_POST['hot']) ? 1 : 0;
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['spmoi'] = isset($_POST['spmoi']) ? 1 : 0;
	$data['spbanchay'] = isset($_POST['spbanchay']) ? 1 : 0;
	
	
	//$data['spnoibat'] = isset($_POST['spnoibat']) ? 1 : 0;
	$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_sanpham,$file_name))
	{
		$data['photo'] = $photo;		
		$data['thumb'] = create_thumb($data['photo'], 400, 400, _upload_sanpham,$file_name,3);	
	}
	$file_name=fns_Rand_digit(0,9,6);
	if($download = upload_image("download", 'doc|docx|xls|xlsx|pdf|rar|zip|7z|jpg|png', _upload_sanpham,$file_name))
	{
		$data['download'] = $download;		
	}
	initSeo($data);
	//check($data);
	if($id){
		
		$id =  themdau($_POST['id']);
		$d->reset();
		
		$data['ngaysua'] = time();
		$d->setTable('product');
		$d->setWhere('id', $id);
		if($d->update($data)){
			saveSizeProduct($id);
			saveColorProduct($id);
			redirect("index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&id_danhmuc=".$_REQUEST['id_danhmuc']."&id_list=".$_REQUEST['id_list']."&id_cat=".$_REQUEST['id_cat']."&id_item=".$_REQUEST['id_item']."");
		}
		else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man");
		}
	}else{

		
		$data['ngaytao'] = time();
		$d->setTable('product');
		if($d->insert($data)){
			$d->query("select id from #_product order by id desc limit 1");
			$r = $d->fetch_array();
			saveSizeProduct($r['id']);
			saveColorProduct($r['id']);
			redirect("index.php?com=product&act=man");
			}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man");
	}
}
function saveSizeProduct($id){
	global $d;
	$sid = array();
	$enable = array();
	foreach($_POST['size'] as $k=>$v){
		$sid[] = $k;
		$d->query("select 	id from #_product_size_condition where id_size = ".$k." and id_product = ".$id);
		if(!$d->num_rows()){
			$enable[] = "(".$k.",".$id.")";
		}
	}
	if(count($sid)> 0){
	$sql = "delete from #_product_size_condition where id_size not in(".implode(",",$sid).") and id_product = ".$id;
	}else{
		$sql = "delete from #_product_size_condition where id_product = ".$id;
	}
	$d->query($sql);
	if(count($enable) > 0){
		$d->query("insert into #_product_size_condition(id_size,id_product) value ".implode(",",$enable));
	}	
}
function saveColorProduct($id){
	global $d;
	$sid = array();
	$enable = array();
	$update = array();
	foreach($_POST['color'] as $k=>$v){
		$color_image = array();
		$sid[] = $k;
		$d->query("select id from #_product_color_condition where id_color = ".$k." and id_product = ".$id);
		foreach($_POST['color'.$k] as $k2=>$v2){
			
			if($v2!=''){
				$color_image[] = $v2;
			}
		}
		if(!$d->num_rows()){
			
			$enable[] = "(".$k.",".$id.",'".json_encode($color_image)."')";
		}else{
			
			
			$update[$k] = json_encode($color_image);
		}
	}
	if(count($sid) > 0){
	$sql = "delete from #_product_color_condition where id_color not in(".implode(",",$sid).") and id_product = ".$id;
	}else{
	$sql = "delete from #_product_color_condition where id_product = ".$id;	
	}
	$d->query($sql);
	if(count($enable) > 0){
		$d->query("insert into #_product_color_condition(id_color,id_product,image) value ".implode(",",$enable));
	}	
	
	if(count($update) > 0){
		foreach($update as $k=>$v){
			
			$d->query("update #_product_color_condition set image = '".$v."' where id_color = ".$k." and id_product = ".$id);
		}
		
	}
	
}
function delete_item(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);			
			}
		$sql = "delete from #_product where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select id,thumb, photo from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=product&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man");
		
}



function chuyencap_cat(){	
	global $d;
	$d->reset();
	$capchuyen = $_REQUEST['capchuyen'];
	$id_cat = $_REQUEST['id_cat'];
	if($id_cat == 0)
	{
		transfer("Bạn chưa chọn danh mục cần chuyển", "index.php?com=product&act=chuyencap_cat");
	}
	if($capchuyen == 2)
	{
		#####Lấy id_list MAX
		$sql = "SELECT id FROM table_product_list ORDER BY id desc";
		$d->query($sql);
		$max1 = $d->result_array();
		$max = $max1[0]['id']+1;
		
		#####Lấy id_list của danh mục cần chuyển cấp
		$sql = "SELECT id_list FROM table_product_cat WHERE id='".$id_cat."'";
		$d->query($sql);
		$id_list1 = $d->result_array();
		$id_list = $id_list1[0]['id_list'];
			
		
		$sql = "INSERT INTO table_product_list (ten,tenkhongdau,photo,hienthi,ngaytao,ngaysua,stt_danhmuc) 
	SELECT ten,tenkhongdau,photo,hienthi,ngaytao,ngaysua,stt_danhmuc FROM table_product_cat WHERE id='".$id_cat."'";
		$result = $d->query($sql);
		if($result == true)
		{
			$sql2 = "UPDATE table_product SET id_list='".$max."' WHERE id_list ='".$id_list."' and id_cat='".$id_cat."'";
			$result = $d->query($sql2);
			if($result == true)
			{
				$sql3 = "DELETE from table_product_cat WHERE id='".$id_cat."'";
				$result = $d->query($sql3);
				if($result == true)
				{
					transfer("Bạn đã chuyển từ danh mục cấp 3 lên danh mục cấp 2", "index.php?com=product&act=man_cat");
				}
			}				
		}
	}
	else if($capchuyen == 4)
	{
		transfer("Chuyển cấp này chưa được làm", "index.php?com=product&act=chuyencap_cat");
	}
}

/*---------------------------------*/
function get_cats(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product_cat where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	$sql = "select * from #_product_cat";	
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".$_REQUEST['id_danhmuc']."";
	}
	if((int)@$_REQUEST['id_list']!='')
	{
	$sql.=" where id_list=".$_REQUEST['id_list']."";
	}
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man_cat&id_danhmuc=".@$_GET['id_list']."&id_list=".@$_GET['id_list'];
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_cat(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list");
	
	$sql = "select * from #_product_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_cat");
	$item = $d->fetch_array();	
}

function save_cat(){
	global $d,$config;
	$file_name=$_FILES['file']['name'];
	$data = array();
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
	$data['id_list'] = (int)$_POST['id_list'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	initSeo($data);
	foreach($config['lang'] as $k=>$v){
	
		$data['ten_'.$v] = $_POST['ten_'.$v];
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);
		}
	}
	
	
	
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
				
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		
		$data['ngaysua'] = time();
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_list");
	}else{		
		 if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			
		}
		$data['ngaytao'] = time();	
		$d->setTable('product_cat');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_cat");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_cat");
	}
}
function delete_cat(){
	global $d;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();		
			
			//Xóa danh mục cấp 3
			$sql = "select id,thumb,photo from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 4			
			$sql = "select id,thumb,photo from #_product_item where id_cat='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_item where id_cat='".$id."'";
				$d->query($sql);
			}
			//Xóa sản phẩm thuộc loại đó			
			$sql = "select id,thumb,photo from #_product where id_cat='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product where id_cat='".$id."'";
				$d->query($sql);
			}
		
		
		if($d->query($sql))
			redirect("index.php?com=product&act=man_cat");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_cat");

	

	}elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product_item where id_cat='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product where id_cat='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=product&act=man_cat");} else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat"	    );
							
}
/*---------------------------------*/
function get_lists(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_product_list where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$noibat=$cats[0]['noibat'];
	if($noibat==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_list SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	$sql = "select * from #_product_list ";	
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".$_REQUEST['id_danhmuc']."";
	}
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man_list&id_danhmuc=".@$_GET['id_danhmuc'];
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_list(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list");
	
	$sql = "select * from #_product_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_list");
	$item = $d->fetch_array();	
}

function save_list(){
	global $d,$config;
	$file_name=$_FILES['file']['name'];
	$data = array();
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
	foreach($config['lang'] as $k=>$v){
	
		$data['ten_'.$v] = $_POST['ten_'.$v];
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);
		}
	}
	initSeo($data);
	
	
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
				
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		
		$data['ngaysua'] = time();
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_list");
	}else{		
		 if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			
		}
		$data['ngaytao'] = time();	
		$d->setTable('product_list');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_list");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_list");
	}
}

function delete_list(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
		
			//Xóa danh mục cấp 2			
			$sql = "select id,thumb,photo from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 3
			$sql = "select id,thumb,photo from #_product_cat where id_list='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 4			
			$sql = "select id,thumb,photo from #_product_item where id_list='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_item where id_list='".$id."'";
				$d->query($sql);
			}
			//Xóa sản phẩm thuộc loại đó			
			$sql = "select id,thumb,photo from #_product where id_list='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product where id_list='".$id."'";
				$d->query($sql);
			}
		
		
		if($d->query($sql))
			redirect("index.php?com=product&act=man_list");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_list");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product_cat where id_list='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product_item where id_list='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product where id_list='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=product&act=man_list");} else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list"	    );
}


/*---------------------------------*/
function get_danhmucs(){
	global $d, $items, $paging;
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product_danhmuc where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_danhmuc SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_danhmuc SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_product_danhmuc where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$noibat=$cats[0]['noibat'];
	if($noibat==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_danhmuc SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product_danhmuc SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	$sql = "select * from #_product_danhmuc";
	if((int)@$_REQUEST['id_danhmuc']!='')
	{
	$sql.=" where id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	$sql.=" order by stt desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man_danhmuc";
	$maxR=20;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_danhmuc(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_danhmuc");
	
	$sql = "select * from #_product_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_danhmuc");
	$item = $d->fetch_array();	
}

function save_danhmuc(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,6);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_danhmuc");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data = array();
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	
	foreach($config['lang'] as $k=>$v){
		$data['ten_'.$v] = magic_quote($_POST['ten_'.$v]);
		if(!$data['tenkhongdau']){
			$data['tenkhongdau'] = changeTitle($_POST['ten_'.$v]);
		}
	}
	initSeo($data);
	if($id){		
		$id =  themdau($_POST['id']);
				
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_sanpham,$file_name,3);
			
			$d->setTable('product_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('product_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_danhmuc&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_danhmuc");
	}else{			
				
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',_upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400,300, _upload_sanpham,$file_name,3);
			
			
		}
     
		$data['ngaytao'] = time();
		
		$d->setTable('product_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_danhmuc");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_danhmuc");
	}
}

function delete_danhmuc(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
			//Xóa danh mục cấp 1
			$sql = "delete from #_product_danhmuc where id='".$id."'";
			$d->query($sql);
			//Xóa danh mục cấp 2			
			$sql = "select id,thumb,photo from #_product_list where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_list where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 3
			$sql = "select id,thumb,photo from #_product_cat where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
			//Xóa danh mục cấp 4			
			$sql = "select id,thumb,photo from #_product_item where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_item where id_danhmuc='".$id."'";
				$d->query($sql);
			}
			//Xóa sản phẩm thuộc loại đó			
			$sql = "select id,thumb,photo from #_product where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product where id_danhmuc='".$id."'";
				$d->query($sql);
			}
		
		
		if($d->query($sql))
			redirect("index.php?com=product&act=man_danhmuc");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_danhmuc");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			
				$sql = "delete from #_product_danhmuc where id='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product_list where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product_cat where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product_item where id_danhmuc='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product where id_danhmuc='".$id."'";
				$d->query($sql);
			
		} redirect("index.php?com=product&act=man_danhmuc");} else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_danhmuc"	    );
}


function capnhatsoluong(){
	global $d, $item;
	$d->query("SET NAMES 'utf8'");
	if(isset($_POST['id'])){
		
		$ar = array();
		foreach($_POST['ten'] as $k=>$v){
			if($v){
			$row['ten'] = $v;
			$row['soluong'] = $_POST['soluong'][$k];
			$ar[] = $row;
			}
		}
		$d->query("SET NAMES 'utf8'");
		
		$sql = "update #_product_soluong set content ='".magic_quote(json_encode($ar))."'";
		$d->query($sql);
		transfer("Cập nhật thành công", "index.php");
	}
	$sql = "select * from #_product_soluong";
	$d->query($sql);
	
	$item = $d->fetch_array();	
}
?>


