<script src="assets/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="assets/image_anim/galleria-1.2.8.min.js" type="text/javascript"></script>
<link href="assets/image_anim/galleria.folio.css" type="text/css" rel="stylesheet" />

<div id="content">
<div id="content">
<div class="scroll">
<link rel="stylesheet/less" type="text/css" href="assets/css/less/news.less">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="news-content">
	<div class="col-xs-12">
		<div class="header">
			<h2 class="zirkon"><?=$row_detail['ten_'.$lang]?></h2>
			<p><?php include _template."layout/share.php";?></p>
			
		</div>
		<div class="main-product-detail">
				
					<div class="content">
							<?php if($row_detail['maso']){
							echo '<p class="z">'._masp.'<strong> '.$row_detail['maso'].'</strong></p>';
							}?>
							<?php 
							
								if($row_detail['gia']){
									echo '<p class="z">Giá : '.myformat($row_detail['gia']).'</p>';
								
								}
								$d->query("select * from #_loaiphong where id= ".$row_detail['id_loaiphong']);
								$rs = $d->fetch_array();
								echo '<p class="z">Loại phòng : '.$rs['ten_'.$lang].'</p>';
							?>
							
						
								
							
					</div>
					
				</div>  
		<div class="content">   
			
			<?=$row_detail['noidung_'.$lang]?><br />     
			
			<div id="container1">
				<?php
					$gallery = json_decode($row_detail['gallery']);
					if(count($gallery) > 0){
						foreach($gallery as $k=>$v){
							?>
							 <div class="box photo col2" >
									<a href="<?=$config_url.$v?>">
									<img src="<?=$config_url.$v?>" alt="<?=$row_detail['ten_'.$lang]?>" /></a>
							</div>
							
							
							<?php
						
						
						}
					?>
					
					    <script>

					Galleria.loadTheme('assets/image_anim/galleria.folio.min.js');
								$("#container1").galleria({
									
									height:100,
									imageCrop: false,
									maxScaleRatio: 1,
									preload: 3,
									fullscreenTransition:'slide'
								});
								Galleria.run('#container1', {
								  height: parseInt($('#container1').css('height')),
								  wait: true
								 });
								
								
  $(function(){

    var $container = $('#container1');
  
    $container.imagesLoaded( function(){
		
      $container.masonry({
        itemSelector : '.box'
      });
    });
  
  });
  setTimeout(function(){initScrollBar();},2000);


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
</div>
</div>
</div>
<style>


</style>