<?php 
	$d->query("select id,ten_$lang,tenkhongdau from #_product_danhmuc where hienthi = 1  order by stt desc ");
	foreach($d->result_array() as $k2=>$v2){
		?>

<section>
<div class="box-content">
			<div class="wrap-product">
			<div class="product-group ">
					<div class="ori-title" style="width:100%;position:relative"><h2><?=$v2['ten_'.$lang]?></h2></div>
					<div class="">
						<ul class="xa">
							<?php 
							
								$d->query("select * from #_product where hienthi = 1 and id_danhmuc = ".$v2['id']." order by stt desc limit 16");
								foreach ($d->result_array() as $k => $v) {
					   $i++;
					   ?>
					   <?php 
						
							echo '<li class="">';
						
					   ?>
						
					   <div class="product-item-wrap">
						<div class="product-item ">
								<div class="">	
								
									<div class="product-image">
										 <a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>">
										<div class="wrap">
									   <img class="img-responsive has-tt" src="timthumb.php?src=<?=$config_url."/"._upload_sanpham_l . $v['photo']?>&w=206&h=164" alt="" />
										</div></a>
									</div>
									
									<div class="product-name">
										<h2><a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>"><?php echo $v['ten_' . $lang] ?></a></h2>
									</div>
									<div class="product-code">
										BXS: <?=$v['maso']?>
									</div>
									<div class="clearfix"></div>
									<div class="view-detail">
										<div class="view-button anim">
											<a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>">Xem chi tiết</a>
										</div>
									</div>
									<div class="product-price">
										<?=_price?> :&nbsp;<span><?=($v['gia']) ? myformat($v['gia']) : "<a href='lien-he.html'>"._contact.'</a>'?></span>
									</div>
									<div class="product-detail">
										 <a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>">Xem chi tiết</a>
									</div>
									 <div  class="cart"><a onclick="addToCart(<?=$v['id']?>,'<?=$v['ten_'.$lang]?>');return false;" href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>" >Mua Hàng</a></div>
								</div>
							</div><!-- product-item -->
						</div>
						<?php 
						
							echo '</li>';
								}
						?>
								
							
						
						</ul>
					</div>
			</div>				
			<div class="clearfix"></div>
				
			</div>
			</div>
            
</section>
	
	
	
	<?php } ?>
	
	
	
	
	<script>
	$().ready(function(){
		$(".product-group ul.xa").bxSlider({
			minSlides:4,
			maxSlides:4,
			moveSlides:1,
			auto:0,
			controls:1,
			pager:0,
			slideWidth:220,
			slideMargin:15,
			
			
		})
	})
	</script>



