<script src="assets/mansory/js/modernizr.custom.js"></script>
<script src="assets/mansory/dist/masonry.pkgd.min.js" type="text/javascript" ></script>
<script src="assets/mansory/imagesloaded.js" type="text/javascript" ></script>
<script src="assets/mansory/js/classie.js" type="text/javascript" ></script>
<script src="assets/mansory/js/AnimOnScroll.js" type="text/javascript" ></script>
<link href="assets/mansory/component.css" type="text/css" rel="stylesheet" />
<link href="assets/prettyphoto/css/prettyPhoto.css" type="text/css" rel="stylesheet" />
<script src="assets/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript" ></script>
<div class="title-global"><h2><?=$rs_['ten_'.$lang]?></h2></div>
<div id="gallery-wrap">
<?php
	
	$d->reset();
	$d->query("select * from #_photo where com = '".$_GET['com']."' and id_cat = ".@$rs_['id']);
	//check($d->result_array());
	echo '<ul class="grid effect-2" id="grid">';
	
	foreach($d->result_array() as $k=>$v){
		$ytb = false;
		$link = $v['photo'];
		
		if(!$v['mota']){
			$v['mota'] = 'No title';
		}
		if(videoType($v['photo'])=='youtube'){
			$ytb = "ytb";
			
			$v['photo'] = 'http://img.youtube.com/vi/'.getYoutubeIdFromUrl($v['photo']).'/0.jpg';
		}else{
			if(!checkValidUrl($v['photo'])){
				$v['photo'] = _upload_hinhanh_l.$v['photo'];
			}
			$link = $v['photo'];
		}
			
		echo ' <li class="item '.$ytb.'"><div class="rel"><a rel="prettyPhoto[gallery1]" title="'.$v['mota'].'"href="'.$link.'"><img src="'.$v['photo'].'" /></a><div class="desc">'.$v['mota'].'</div></div></li>';
	}
	echo '<div class="clear"></div>';
	echo '</ul>';

?>
<div class="clear"></div>
</div>
<script type="text/javascript">
$().ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto();
})
new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );

</script>

