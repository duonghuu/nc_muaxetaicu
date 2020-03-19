<?php	

	$d->reset();
	$sql_contact = "select * from #_hotline ";
	$d->query($sql_contact);
	$rs = $d->fetch_array();
	$d->reset();
	$d->query("select * from #_yahoo where id = 13");
	$support = $d->fetch_array();
	$d->reset();
	$d->query("select * from #_social where hienthi = 1"); 
	$social = $d->result_array();
	$d->reset();
	$d->query("select * from #_footer "); 
	$footer = $d->fetch_array();	
	

?>
<footer>
	
	<div class="container">
		<div class="container">
		
		<div class="wrap-content-header">
	
		<div id="logo" class="col-xs-8	">
			<div class="row">
			<?=$footer['noidung_'.$lang]?>
			<!--
			<h1 class="name"><?=$result_hotline['ten_'.$lang]?></h1>
			<p><?=_address?> : <?=$result_hotline['diachi_'.$lang]?></p>
			<p><?=_phone?> : <?=$result_hotline['dienthoai_'.$lang]?></p>
			<p>Email : <?=$result_hotline['email_'.$lang]?></p>
			-->
			</div>
			
		</div>
		<div id="search-social-bar" class="col-xs-3 pull-right ">
			<div class="row">
			
			<div class="lang-bar pull-right">
			<div class="title"><?=_thongke?></div>
				<?php
				
				
				$statictis = count_online();
				
				
				?>
				<div class="content analytics">
					<div class="ana-item">
				
					<label><img src="assets/ico/online.png">&nbsp;<?=_visit_online?></label>: <?=$statictis['dangxem']?> 
				</div>
				<div class="ana-item">
					<label><img src="assets/ico/total-online.png">&nbsp;<?=_visit_all?>: </label>: <?=myformat($statictis['daxem'],'')?> 
				</div>
				<?php
					/* foreach(json_decode($product_counter['content']) as $k=>$v){
						echo '<div class="ana-item"><label>'.$v->ten.'</label>:'.$v->soluong.'</div>';
					} */
					?>
			</div>
				
			</div>
			</div>
			
		</div><!-- search-social-bar -->
		</div><!-- end wrap-content-header -->
		
		</div><!-- end container -->
	</div>
	</footer>	
