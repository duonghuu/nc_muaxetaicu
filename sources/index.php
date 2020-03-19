<?php  if(!defined('_source')) die("Error");
			
			
		$d->reset();
		$d->query("select * from #_baiviet where id = 1");
		$rs_about = $d->fetch_array();
		
		
	
                    $d->query("select * from #_product where hienthi = 1 and noibat = 1  order by stt desc");
                    $product = $d->result_array();
                  
					$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
					 $url = "index.html";
						$maxR=$global_setting['product_paging'];
					$maxP=5;
					$paging = paging_home($product, $url, $curPage, $maxR, $maxP);
					
					$product = $paging['source'];
					
					

?>