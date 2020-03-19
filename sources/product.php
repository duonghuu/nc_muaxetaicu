<?php  if(!defined('_source')) die("Error");

@$id_danhmuc =  addslashes($_GET['id_danhmuc']);
@$id_list =  addslashes($_GET['id_list']);
@$id_cat =  addslashes($_GET['id_cat']);
@$id =  addslashes($_GET['id']);

if($id!='')
{
    #các s?n ph?m khác======================
    $sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE id ='".$id."'";
    $d->query($sql_lanxem);

    $sql_detail = "select * from #_product where hienthi=1 and id='".$id."'";
    $d->query($sql_detail);
    $row_detail = $d->fetch_array();
    $product_detail = $row_detail;

    $title_bar=$row_detail['ten_'.$lang].' - ';
	addingSeo($row_detail);
    $sql = "select * from #_product where hienthi=1 and id_list='".$row_detail['id_list']."'  order by stt desc";
    $d->query($sql);
    $product = $d->result_array();

}
elseif($id_cat!='')
{

    $sql = "select ten_$lang,id from #_product_cat where id='$id_cat'";
    $d->query($sql);
    $title = $d->fetch_array();
    $title_bar = $title['ten_'.$lang].' - ';
    $title_cat = $title['ten_'.$lang];
	addingSeo($title);
    $sql = "select * from #_product where hienthi=1 and id_cat='$id_cat'  order by stt desc";
    $d->query($sql);
    $product = $d->result_array();
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
    $product = $paging['source'];
}

elseif($id_danhmuc!='')
{

    $sql = "select * from #_product_danhmuc where id='$id_danhmuc'";
    $d->query($sql);
    $title = $d->fetch_array();
    $title_bar = $title['ten_'.$lang].' - ';
    $title_cat = $title['ten_'.$lang];
	addingSeo($title);
    $sql = "select * from #_product where hienthi=1 and id_danhmuc='$id_danhmuc'  order by stt desc";
    $d->query($sql);
    $product = $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
	
}
elseif($id_list!='')
{

    $sql = "select * from #_product_list where id='$id_list'";
    $d->query($sql);
    $title = $d->fetch_array();
    $title_bar = $title['ten_'.$lang].' - ';
    $title_cat = $title['ten_'.$lang];
	addingSeo($title);
    $sql = "select * from #_product where hienthi=1 and id_list='$id_list'  order by stt desc";
    $d->query($sql);
    $product = $d->result_array();

    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
   $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
	



}
else
{

    $title_bar= _product.' - ';
    $title_cat= _product.'';


    $d->reset();
	$sql = "select * from #_product where hienthi=1  order by stt desc";
	if(isset($type)){
		$sql = "select * from #_product where hienthi=1 and ".$type." = 1 order by stt desc";
		 $title_bar= $prf.' - ';
		$title_cat= $prf.'';
	}
    $d->query($sql);
	
    $product = $d->result_array();
    $curPage = isset($_GET['p']) ? $_GET['p'] : 1;
    $url = getCurrentPageURL();
    $maxR=$global_setting['product_paging'];
    $maxP=5;
    $paging = paging_home($product, $url, $curPage, $maxR, $maxP);
	
    $product = $paging['source'];
 
	

}


?>