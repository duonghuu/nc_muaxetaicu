	<?php
	$d->reset();
	$d->query("select * from #_slider where hienthi = 1 order by stt,id desc");
	$slider = $d->result_array();
	?>
	<div class="" id="slider-wrapper">		
		<div id="slider" >
			<div id="iview">
				<?php
				foreach($slider as $k=>$v){
					echo '<div data-iview:image="'._upload_hinhanh_l.$v['photo'].'" ><a class="" href="'.$v['link'].'" 
					target="_blank" style="position:absolute;width:100%;height:100%;top:0;left:0;z-index:1234""></a></div>';			
				}		
				?>			
			</div>
		</div><!-- end  slider -->	
	</div>
