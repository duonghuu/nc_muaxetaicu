<?php

$sql = "select * from #_product where hienthi = 1 order by stt,id desc";
$d->query($sql);
$rs  = $d->result_array();
$d->reset();
$sql_hotline="select * from #_hotline limit 0,1";
$d->query($sql_hotline);
$result_hotline=$d->fetch_array();
$d->reset();
$sql_hotline="select * from #_lienhe";
$d->query($sql_hotline);
$lienhe_rs=$d->fetch_array();

$sql = "select * from #_photo where com='banner_top' and mota = '".$lang."'";
$d->query($sql);
$rs_banner = $d->fetch_array();
?>
<header>
	
		<div class="container rel container-fixed">
		
		<?php
			$photo = _upload_hinhanh_l.$rs_banner['photo'];
			if(@end(explode(".",$photo)) == "swf"){
			?>
		
<object data="<?=$photo?>" type="application/x-shockwave-flash" height="150" width="1000">
			<param value="<?=$photo?>" name="movie">
			<param value="high" name="quality">
			<param value="transparent" name="wmode">
		</object>
		<?php } else {?>
		<img class="header" class="img-responsive" src="<?=_upload_hinhanh_l.$rs_banner['photo']?>" />
		<?php } ?>
			<?php
		include _template.'layout/social.php';		
	?>
		
		</div>
		<?php
		include_once _template.'layout/menu.php';		
	?>
		
	</header>
	
	
	
