<div class="box-content">
<div class="title-global-root"><h2><?=$title_cat?></h2>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="row">
		
		
		 <div class="wrap-product ">
                       
		
                                    <div class="product-group ">
											
                                            <?php
                                           
                                            foreach ($product as $k => $v) {
                                              
                                               ?>
											    <div class="col-xs-3 product-item-wrap">
						<div class="product-item ">
								<div class="">	
								
									<div class="product-image">
										 <a href="san-pham/<?php echo $v['id'] . "/" . $v['tenkhongdau'] ?>.html" title="<?php echo $v['ten_' . $lang] ?>">
										<div class="wrap">
									   <img class="img-responsive has-tt" src="timthumb.php?src=<?=$config_url."/"._upload_sanpham_l . $v['photo']?>&w=206&h=164" alt="<?=$v['ten_'.$lang]?>" />
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
                                               
                                            }
                                            ?>
                                       

                                        <div class="clearfix"></div><?=$paging['paging']?>

</div>
</div>
		
		
		</div>
		</div>
	
	
	
	
	
				
			
			