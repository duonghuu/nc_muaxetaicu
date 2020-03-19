<?php 
function getSearchDanhmuc(){
	global $d;
	$d->query("select * from #_"._table."_danhmuc order by stt desc");
	$str = "<select id='search_danhmuc' name='id_danhmuc'>";
	$str .= "<option value=''>-Tất cả-</option>";
	foreach($d->result_array() as $k=>$v){
		$str.="<option value='".$v['id']."'>".$v['ten_vi']."</option>";
	}
	$str.="</select>";
	return $str;
	
	
}
function getSearchList($id=null){
	global $d;
	$sql = "select id,ten_vi from #_"._table."_list ";
	
	$sql.=" order by stt desc";
	$d->query($sql);
	$str = "<select id='search_list' name='id_list'>";
	$str .= "<option value=''>-Tất cả-</option>";
	
	foreach($d->result_array() as $k=>$v){
		$str.="<option value='".$v['id']."'>".$v['ten_vi']."</option>";
	}
	$str.="</select>";
	return $str;
	
}
function getSearchCat($id=null){
	global $d;
	$sql = "select id,ten_vi from #_"._table."_cat ";
	if($id){
		
	}
	$sql.=" order by stt desc";
	$d->query($sql);
	$str = "<select id='search_cat' name='id_list'>";
	$str .= "<option value=''>-Tất cả-</option>";
	foreach($d->result_array() as $k=>$v){
		$str.="<option value='".$v['id']."'>".$v['ten_vi']."</option>";
	}
	$str.="</select>";
	return $str;
}