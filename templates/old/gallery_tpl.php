<div class="title-global"><h2><?=$title_cat?></h2></div>
<div id="gallery-wrap">
<?php
		foreach($result as $k=>$v){
			$d->reset();
			$d->query("select * from #_photo where com = '".$_GET['com']."' and id_cat = ".$v['id']." order by rand()");
			
			$count = $d->num_rows();
			$fetch = $d->fetch_array();
			
			if(videoType($fetch['photo'])=='youtube'){
								
				$fetch['photo'] = 'http://img.youtube.com/vi/'.getYoutubeIdFromUrl($fetch['photo']).'/0.jpg';
			}else{
				if(!checkValidUrl($fetch['photo'])){
					$fetch['photo'] = _upload_hinhanh_l.$fetch['photo'];
				}
			}
			
			
			if($count > 0){
				echo '<div class="part-gal">';
				
				echo '<div class="image-root"><div class="wrap"><a title="'.$v['ten_'.$lang].'" href="'.$_GET['com'].'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" /><img src="'.$fetch['photo'].'" /></a></div></div>';
				echo '<div class="name-gal" ><a href="'.$_GET['com'].'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'" >'.$v['ten_'.$lang].' ('.$count.')</a></div>';
				echo '</div>';
			}
			
		}

?>
</div>