<div id="block-air">
<div class="loader"></div>
	<div class="title tt-border"><h3 class="zirkon pull-left"><?=$title_cat?></h3><div class="oz-bbt"></div></div>
	<div class="clearfix"></div>
	<div class="content wrap-content">
		<div class="scroll content-scroll">
			<div class="inner-content">
				<?=$row_detail['noidung_'.$lang]?>
			</div>	
		</div>
		<div class="hidden-link-back" style="display:none">
			<div class="btn-advance"><a href="<?=$com?>.html">BACK</a></div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div id="menu-link">
		<?php 
		
			if(count($tintuc) > 0){
				foreach($tintuc as $k=>$v){
					echo '<div  class="btn-advance"><a href="'.$_GET['com'].'/'.$v['id'].'/'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'">'.$v['ten_'.$lang].'</a></div>';
				
				
				}
			
			
			}
		?>
		<div class="clearfix"></div>
	</div>

