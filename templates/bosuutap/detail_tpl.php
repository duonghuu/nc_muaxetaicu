<link rel="stylesheet/less" type="text/css" href="assets/css/less/news.less">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
 <script src="assets/image_anim/masonry.pkgd.min.js" type="text/javascript"></script>
<script src="assets/image_anim/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="assets/image_anim/galleria-1.2.8.min.js" type="text/javascript"></script>
<link href="assets/image_anim/galleria.folio.css" type="text/css" rel="stylesheet" />	
<div class="news-content">
	<div class="col-xs-12">
		<div class="header">
			<h2><?=$tintuc_detail['ten_'.$lang]?></h2>
			<div class="date"><?=date("d-m-Y",$tintuc_detail['ngaytao'])?></div>
			<?php include _template."layout/share.php";?>
		</div>
		<div class="description">
			<?=$tintuc_detail['mota_'.$lang]?>
		</div>   
		<div class="content">   
			
			<?=$tintuc_detail['noidung_'.$lang]?><br />         
<div class="clearfix"></div>
<div id="container1">
				<?php
					$gallery = json_decode($tintuc_detail['gallery']);
					if(count($gallery) > 0){
						foreach($gallery as $k=>$v){
							?>
							 <div class="box photo col2" style="opacity:0" >
									<a href="<?=$config_url.$v?>">
									<img src="timthumb.php?src=<?=$config_url.$v?>&w=230" alt="<?=$result['ten_'.$lang]?>" /></a>
							</div>
							
							
							<?php
						
						
						}
					?>
					
					    <script>
						setTimeout(function(){

					Galleria.loadTheme('assets/image_anim/galleria.folio.min.js');
								$("#container1").galleria({
									
									//height:100,
									imageCrop: false,
									maxScaleRatio: 1,
									preload: 3,
									fullscreenTransition:'slide'
								});
								Galleria.run('#container1', {
								  height: parseInt($('#container1').css('height')),
								  wait: true
								 });
								 $(".photo").fadeIn();	
								 initScrollBar();
								 
								 Galleria.on('image', function(e) {
										 initScrollBar();
									});
								},1000);
								
  $(function(){

    var $container = $('#container1');
  
    $container.imagesLoaded( function(){
      $container.masonry({
        itemSelector : '.box'
      });
    });
  
  });


						</script>
					
					
					
					<?php 
					
					}
				
				
				?>
			
			</div>
		
			<?php
			  if(count($tintuc_khac) > 0) { ?>
				<div class="other-news">
					 <h3><?=$more?></h3>
					 <ul>          
						<?php foreach($tintuc_khac as $tinkhac){?>
						<li>&raquo;&nbsp;<a href="<?=$com?>/<?=$tinkhac['id']?>/<?=$tinkhac['tenkhongdau']?>.html" style="text-decoration:none;" title="<?=htmlentities($tinkhac['ten_'.$lang], ENT_QUOTES, "UTF-8")?>"><?=$tinkhac['ten_'.$lang]?></a> <span class="date">(<?=make_date($tinkhac['ngaytao'])?>)</span></li>
						<?php }?>
					 </ul>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
