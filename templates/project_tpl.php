<section id="main-view">
<div class="title-global"><h2><?=_projects?></h2></div>
<div class="projects-main">
<div class="slidemenu-project is-project">
<div class="project-navwrap">
	<a href="javascript:void(0);" class="jcarousel-control-prev slidemenu-left btn"></a>
	<a href="javascript:void(0);" class="jcarousel-control-next slidemenu-right btn"></a>
	</div>
  <div class="jcarousel-wrapper">
        <div class="jcarousel">
            <ul>
<?php

    $i=0;

	foreach($result as $k=>$v){

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
        $cls = '';
        if($k==1){
            $cls = 'centerframe';
        }
        if($i==0){
		echo '<li class="slidemenu-item project anim '.$cls.'">
				<div class="full-projects">
				<a class="fancybox" rel="gal" title="'.$v['mota'].'" href="'.$v['photo'].'"  onclick="" ><div class="project-left">

				<img src="'.$v['photo'].'" alt="p1"/>
				<span><h2>'.$v['mota'].'</h2></span>
			 </div></a>';
            $i++;
        }else{
              echo '<a class="fancybox" rel="gal" title="'.$v['mota'].'" href="'.$v['photo'].'"  onclick="" ><div class="project-right">

			  <img src="'.$v['photo'].'" alt="p1"/>
			  <span><h2>'.$v['mota'].'</h2></span>
			  </div></a></div></li>';
              $i = 0;

         }



$X = '<li class="item '.$ytb.'"><div class="rel"><a rel="prettyPhoto[gallery1]" title="'.$v['mota'].'"href="'.$link.'"><img src="'.$v['photo'].'" /></a><div class="desc">'.$v['mota'].'</div></div></li>';
	}

	echo '</ul>';

?>
                </div></div>
<div class="clear"></div>
</div></div>
</section>


