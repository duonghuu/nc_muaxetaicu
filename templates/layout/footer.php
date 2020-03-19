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
	<div class="">
	<div class="top-footer">
		
		<div class="clearfix"></div>
		<div class='all-wrap-footer'>
		<div class="col-xs-5 company-name">
		<div class="fix-row">
		<div class="title">THÔNG TIN LIÊN HỆ</div>
				<?=$footer['noidung_'.$lang]?>
			
			
		</div>
		</div>
		<div class='col-xs-7'>
			<div class="row">
		
		
		
		
		
		
		
		
		<div class="col-xs-4 company-name">
		<div class="fix-row">
		<div class="title">HỖ TRỢ KHÁCH HÀNG</div>
				<div class="content">
				<?php 
					$d->query("select * from #_project where hienthi = 1 order by stt desc");
					echo '<ul>';
					foreach($d->result_array() as $k=>$v){
						echo '<li><a href="ho-tro-khach-hang/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">&raquo;&nbsp;'.$v['ten_'.$lang].'</a></li>';
					}
					echo '</ul>';
				?>
			
			</div>
			
			
			
		</div>
		</div>
		
				
		<div class="col-xs-4 company-name">
		<div class="fix-row">
		<div class="title">QUY ĐỊNH MUA BÁN</div>
			<div class="content">
				<?php 
					$d->query("select * from #_info where hienthi = 1 order by stt desc");
					echo '<ul>';
					foreach($d->result_array() as $k=>$v){
						echo '<li><a href="quy-dinh-mua-ban/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">&raquo;&nbsp;'.$v['ten_'.$lang].'</a></li>';
					}
					echo '</ul>';
				?>
			
			</div>
			
			
		</div>
		</div>
		
		<div class="col-xs-4 company-name">
		<div class="fix-row">
		<div class="title">THỐNG KÊ TRUY CẬP</div>
			<div class="content">
				<?php $ana = count_online();?>
		<div class="s1"><img src="assets/img/s1.png" />Đang online : <span class=""><?=$ana['dangxem']?></span></div>
		<div class="s2"><img src="assets/img/s2.png" />Thống kê tuần : <span class=""><?=$ana['advance']['week']?></span></div>
		<div class="s3"><img src="assets/img/s3.png" />Thống kê tháng : <span class=""><?=$ana['advance']['month']?></span></div>
		<div class="s3"><img src="assets/img/s4.png" />Tổng : <span class=""><?=$ana['advance']['all']?></span></div>
			
			</div>
			
			
		</div>
		</div>
		
	</div>
	</div>
	<div class="clearfix"></div>
			
	</div><!-- end all-wrap--foter -->
	</div>
	</div>
	</div>
	<div class="copyright">
		<div class="container">
			<div class="cop pull-left">
			Copyright SALON ÔTÔ TIẾN THÔNG Ltd., Co
			</div>
			<div class="pull-right">
				<?php include _template."layout/social.php" ?>
			</div>
		</div>
	</div>
	</footer>	
	