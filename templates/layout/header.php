<?php
$sql = "select * from #_product where hienthi = 1 order by stt,id desc";
$d->query($sql);
$rs  = $d->result_array();

$d->reset();
$sql_hotline="select * from #_hotline limit 0,1";
$d->query($sql_hotline);
$result_hotline=$d->fetch_array();
$so_hotline = preg_replace('/[^0-9]/','',$result_hotline['hotline_vi']);

$d->reset();
$sql_hotline="select * from #_lienhe";
$d->query($sql_hotline);
$lienhe_rs=$d->fetch_array();

$sql = "select * from #_photo where com='banner_top' and mota = '".$lang."'";
$d->query($sql);
$rs_banner = $d->fetch_array();

$photo = _upload_hinhanh_l.$rs_banner['photo'];
?>
<header>
	<div class="hd-top">
		<div class="container">
			<div class="hd-top-flex">
				<div class="hd-info">
					<a href="">
						<img class="header" class="img-responsive" src="<?=_upload_hinhanh_l.$rs_banner['photo']?>" />
					</a>
					<p>Địa chỉ: <?= $result_hotline["diachi_vi"] ?></p>
				</div>
				<div class="hd-hotline">
					<p><span>Hotline: </span><a href="tel:<?= $so_hotline ?>" ><?= $result_hotline['hotline_vi'] ?></a></p>
				</div>
			</div>
		</div>
	</div>      <!-- end hd-top  -->
		<?php
		include_once _template.'layout/menu.php';		
		?>
	</header>
	
	
	
