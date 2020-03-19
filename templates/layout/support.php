<?php
$d->query("select * from #_yahoo where hienthi = 1 order by stt asc");
if($d->num_rows() > 0){
$rs_yahoo = $d->result_array();
?>
<div id="support-footer">
	<div class="title-footer">HỖ TRỢ TRỰC TUYẾN</div>
	<div class="content">
		
		<?php
			foreach($rs_yahoo as $k=>$v){
				echo '<div class="support-item">';
				echo '<div><strong>&raquo;&nbsp;'.$v['ten'].'</strong></div>';
				echo '<div>';
				if($v['yahoo']){
					echo '<a class="pull-left" style="margin-right:7px" href="ymsgr:sendIM?'.$v['yahoo'].'"><img  width=20 src="assets/img/yahoo.png"></a>';
				}
				if($v['skype']){
				
					echo '<a class="pull-left" style="margin-right:7px"  href="skype:'.$v['skype'].'?chat"><img  width=20 src="assets/img/skype.png"></a>&nbsp;&nbsp;&nbsp;';
				}
				
				if($v['dienthoai']){
					echo ''.$v['dienthoai'].'';
				}
				echo '<div class="clearfix"></div>';
				echo '</div>';
				if($v['email']){
					echo '<div><a href="mailto:'.$v['email'].'">'.$v['email'].'</a></div>';
				}
				echo '</div>';
			
			}
		
		?>
	
	</div>
</div>
<style>
	#support-footer{position:fixed;bottom:0;right:90px;z-index:300;visibility:hidden}
	#support-footer .title-footer{background: #007DDE;cursor:hand;cursor:pointer;
color: #fff;
padding: 5px 30px;
text-align: center;
border: 1px solid #fff;
border-top-left-radius: 3px;
border-top-right-radius: 3px;
border-bottom: 0;}
	#support-footer .content{padding:5px;background:#fff;border:1px solid #ccc;border-top:0}
	#support-footer .content .support-item{border-bottom:1px dashed #ccc}
	
</style>
<script>
$().ready(function(){
	$h = $("#support-footer .content").height()+10;
	$("#support-footer").css({bottom:-$h,"visibility":"inherit"});
	
	$("#support-footer .title-footer").click(function(){
		if($(this).hasClass("active")){
			$("#support-footer").animate({bottom:-$h});
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			$("#support-footer").animate({bottom:0});
		
		}
		
		
		return false;
	})
	
})
</script>
<?php } ?>


