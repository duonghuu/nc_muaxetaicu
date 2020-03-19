<?php  if(!defined('_source')) die("Error");
			
		if(isset($_GET['keyword'])){
			$tukhoa =  $_GET['keyword'];
			$tukhoa = trim(strip_tags($tukhoa));    	
    		if (get_magic_quotes_gpc()==false) {
    			$tukhoa = mysql_real_escape_string($tukhoa);    			
    		}								
			// cac tin tuc
			$sql_tintuc = "select * from #_product where (ten LIKE '%$tukhoa%') and hienthi=1 order by stt,id desc";			
			$d->query($sql_tintuc);
			$product = $d->result_array();	
			
			$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
			$url=getCurrentPageURL();
			$maxR=12;
			$maxP=5;
			$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
			$product=$paging['source'];
		}	
		
?>