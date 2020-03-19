<script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
<link href="fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<div class="title-global"><h2><?=_location_?></h2></div>
<div class="box_containerlienhe">
	
<div class="content <?php if(count($photos) > 0){ echo 'part'; }?>">
    	<?=$noidung_about?>
		
    <div class="clear"></div>
</div>
<?php
	if(count($photos) > 0){
		echo '<div class="content gallery">';
		$k=0;
		foreach($photos as $k=>$v){
			if($k==0){	
				echo '<a class="fancybox" href="'._upload_hinhanh_l.$v['photo'].'"><img class="big" src="'._upload_hinhanh_l.$v['photo'].'" /></a>';
			}else{
			if($k==1){
				echo '<div class="group-image"><ul>';
			}
			echo '<li><a href="'._upload_hinhanh_l.$v['photo'].'"><img src="'._upload_hinhanh_l.$v['photo'].'" /></a>';
			}
		}
		if($k > 1){
			echo '</ul></div>';
		}
		echo '</div>';
	}



?>
<div class="clear"></div>
</div>

<script>
$().ready(function(){
	$(".fancybox").fancybox();
})
</script>