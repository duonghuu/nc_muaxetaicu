<div class="box-content"><!--<script type="text/javascript" src="assets/cloudzoom/js/cloud-zoom.1.0.2.min.js"></script> -->
 <script type="text/javascript" src="assets/elevatezoom-master/jquery.elevateZoom-3.0.8.min.js"></script> 
 <link type="text/css" rel="stylesheet" href="assets/Elastislide/css/elastislide.css" /> 
 <script type="text/javascript" src="assets/Elastislide/js/modernizr.custom.17475.js"></script> 
 <script type="text/javascript" src="assets/Elastislide/js/jquerypp.custom.js"></script> 
 <script type="text/javascript" src="assets/Elastislide/js/jquery.elastislide.js"></script> 
<div class="" id="product-detail">
	<div id="detail">
		
		<div class="title"><?=_product_detail?></div>
			<div class="col-xs-6" id="main-detail">
					<div class="row">
						<div id="x_refesh">   
							<div class="wrap-on-image">
								<img id="img_01" class="img-thumbnail" src="<?=_upload_sanpham_l.$row_detail['photo']?>" data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>"/>
							</div>
							<div id="gal1">
							<ul id="carousel" class="bx-slides">
							<li><a href="#" data-image="<?=_upload_sanpham_l.$row_detail['photo']?>" data-zoom-image="<?=_upload_sanpham_l.$row_detail['photo']?>"><img id="img_01" src="<?=_upload_sanpham_l.$row_detail['thumb']?>" /> </a></li>
							<?php
								
									$ar = json_decode($row_detail['gallery']);
									if(count($ar) > 0){
													foreach($ar as $k=>$v){?>
														<li><a href="#" data-image="<?=$config_url.$v?>" data-zoom-image="<?=$config_url.$v?>">
														<img id="img_01" src="<?=$config_url.$v?>" class="img-responsive"/>
														</a></li>
													<?php
													}										
									}
									?>
									</ul>
							</div>
							
							</div>
						</div><!--zoom-section end-->
				</div>
				
				<div class="col-xs-6 main-product-detail">
					<div class="title"><h1><?=$row_detail['ten_'.$lang]?></h1></div>
					<?php include _template."/layout/share.php"?>
					<div class="clearfix"></div>
					<div class="content">
						<ul class="ul-list-product-detail">
							<?php 
							if($row_detail['maso']){?>
							<li><?=_masp?>: <span class="code"><?=$row_detail['maso']?></span></li>
							<?php } ?>
							<?php 
								if($row_detail['giacu']){
									echo '<li class="old-price">'._giacu.': <span>'.myformat($row_detail['giacu']).'</span></li>';
									echo '<li class="new-price">'._giamoi.': <span>'.myformat($row_detail['gia']).'</span><span class="percent">'._tietkiem.' <strong class="red">'.getPercent($row_detail['giacu'],$row_detail['gia']).'%</strong></li>';
								}else{
									echo '<li>'._gia.': <span>'.(($row_detail['gia']) ? myformat($row_detail['gia']) : '<a href="lien-he.html">'._contact.'</a>').'</span></li>';
									
								}
							
							?>
							<li><?=_luotxem?>: <span class="fnr"><?=$row_detail['luotxem']?></span></li>
							
						
						<script>
						var color_image_default = <?=json_encode(array_merge(array("/"._upload_sanpham_l.$row_detail['photo']),objectToArray(json_decode($row_detail['gallery']))))?>;
						</script>
						<?php 
							$colors = getColorByProductId($row_detail['id']);
							
							if(count($colors) > 100){
								echo '<li id="p_color"><div class="pull-left">Màu sắc</div><div class="clearfix"></div>';
									foreach($colors as $k=>$v){
										echo '<script> var color_image_'.$v['id_color'].' = '.($v['image']).';</script>';
										echo '<div class="color_item" data-id="'.$v['id_color'].'" style="background:'.$v['bg_color'].';color:'.$v['text_color'].'">';
											echo $v['ten'];
										echo '</div>';
									}
									echo '<div class="clearfix"></div>';
								
								echo '</li>';
							}
						
						?>
						
						<?php 
							$sizes = getSizeByProductId($row_detail['id']);
							if(count($sizes) > 100){
								echo '<li id="p_size"><div class="pull-left">Kích cỡ</div><div class="clearfix"></div>';
									foreach($sizes as $k=>$v){
										echo '<div class="size_item" data-id="'.$v['id_size'].'">';
											echo $v['ten'];
										echo '</div>';
									}
									echo '<div class="clearfix"></div>';
								
								echo '</li>';
							}
						
						?>
						
						
								</ul>
								<div class="product-qty hide">
								<label>Chọn số lượng:</label>
								<div><input type="text" value="1" id="qty" /></div>
								<div><button id="add-cart" data-id="<?=$row_detail['id']?>" data-name="<?=$row_detail['ten_'.$lang]?>">Thêm vào giỏ <i class="glyphicon glyphicon-play"></i></button>  </div>
								</div>
							<div class="desc-place">
							<div class="tt"><?=_mota?></div>
							<div class='clearfix'></div>
								<?php echo $row_detail['mota_'.$lang]?>
							</div><!-- end desc-place -->
							<div class="add-cart hide">
								<?=_addcart?> <input type="number" id="qty" value="1">
								<button class="addcart" onclick="addToCart(<?=$row_detail['id']?>,'<?=$row_detail['ten_'.$lang]?>',true)"><i class="glyphicon glyphicon-shopping-cart"></i></button>
							</div>
					</div>
				</div><!-- end main-product-detail -->
				<div class="clearfix"></div>
				<div class="tab-category">
				<!-- Nav tabs -->
						<ul class="tab-nav">
							<li class="active">
								<a href="#thongso-kt"><?=_product_detail?></a>
							</li>
							<li>
								<a href="#comment"><?=_comment?></a>
							</li>
							
						</ul>
						<script>
						$().ready(function(){
						    
							
							$("#qty").change(function(){
								if(!parseInt($(this).val(), 10)){
										$(this).val(1);									
								}
								if(parseInt($(this).val()) < 1){
									$(this).val(1);
								}
							})
							$(".tab-category li a").click(function(){
								$(".tab-category li").removeClass("active");
								$id = $(this).attr("href");
								$(this).parent().addClass("active");
								$(".tab-category .tab").fadeOut(function(){
									$(".tab-category .tab").removeClass("active");
									$(".tab-category .tab"+$id).fadeIn().addClass("active");
									
								})
								
								return false;
							})
							
						})
						</script>
						<div class='clearfix'></div>
						<div class="tab-content">
							<div class="tab active" id="thongso-kt">
								<?=$row_detail['noidung_'.$lang]?>
					  
							</div>
							<div class="tab" id="comment">
								<div id="fb-root"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=580130358671180&version=v2.3";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
								<div class="fb-comments" data-href="<?=getCurrentPageUrl()?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
							</div>
						</div>
				  </div><!-- nav-tabs-->
				<div class="clearfix">
				</div>
	</div>
<div class="clearfix"></div>
					<?php
						$d->query("select * from #_product where id_danhmuc = ".$row_detail['id_danhmuc'].' and id != '.$row_detail['id']." and hienthi  = 1 limit 6");
						$product = $d->result_array();										
					?>	
					<div class="title-global"><h2>SẢN PHẨM CÙNG LOẠI</h2></div>
		<div class="wrap-product row">
                       
								<div class='clearfix'></div>
								
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
                                       

                                        <div class="clearfix"></div>

</div>
</div>	
				</div>
				</div>
	<script>
	function initProduct(){
			$("#carousel").bxSlider({
				
			
				slideMargin: 5,
				minSlides:5,
				maxSlides:5,
				moveSlides:1,
				slideWidth:($("#main-detail").width()/4),
				pager:0,
				
			});
			
			
			
			$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: false,
			 });
			 //pass the images to Fancybox
			 $("#img_01").bind("click", function(e) {
			 var ez = $('#img_01').data('elevateZoom');
			 $.fancybox(ez.getGalleryList()); 
			 return false; });
							}
			$(document).ready(function(){
				initProduct();
							$(".color_item").click(function(){
								$(".color_item").removeClass("active");
								$(this).addClass("active");
								refreshImage(eval("color_image_"+$(this).data("id")));
								
							})
							$(".size_item").click(function(){
								$(".size_item").removeClass("active");
								$(this).addClass("active");
								
							})
							
			
			})

		</script>
			<script>
			function refreshImage($image){
					
					if($image.length > 0){
						first = false;
						$str = '';
						$.each($image,function(index,item){
							if(!index){
							first = item;
							}
							$str+='<li><a href="#" data-image="<?=$config_url?>'+item+'" data-zoom-image="<?=$config_url?>'+item+'"><img id="img_01" src="<?=$config_url?>'+item+'" /> </a></li>';
							
							
						})
						$strx= '<div class="wrap-on-image"><img id="img_01" class="img-thumbnail" src="<?=$config_url?>'+first+'" data-zoom-image="<?=$config_url?>'+first+'"/></div>';
						$strx+='<div id="gal1"><ul id="carousel" class="bx-slides">';
						$strx+=$str+"</ul></div>";
					$("#x_refesh").html($strx);
					initProduct();
					}else{
						refreshImage(color_image_default);
						
						
					}
					
				
			}
			$().ready(function(){
				$h = $("#product-detail .desc-place").height();
				if($h > 200){
					$("#product-detail .desc-place").css({"overflow-y":"scroll"});
				}
				$("#product-detail .desc-place").css({visibility:"visible"});

				$(".product-bx").bxSlider({
					minSlides:4,
					maxSlides:4,
					moveSlides:1,
					slideWidth:$("#main-detail").width()/4,
					pager:0,
					
				})
				
			})
			
			</script>
