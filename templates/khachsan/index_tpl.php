<div id="content">
<div id="content">
<div class="scroll">
<link href="assets/css/news.css" type="text/css" rel="stylesheet" />
<div class="box_containerlienhe">
<div class="title-global"><h2><?=$title_cat?></h2></div>

<div class="col-xs-12">
<div class="product-group row">
						<?php
							$i=0;
							
							foreach($product as $k=>$v){
								$i++;
								?>
								<div class="col-xs-6 col-sm-6 col-md-4">
								<div class="product-item anim ">
								<div class="product-image">
									<a href="<?=$com?>/<?php echo $v['id']."/".$v['tenkhongdau']?>.html" title="<?php echo $v['ten_'.$lang]?>"><img class="img-responsive" src="<?php if($v['thumb']!=NULL) echo _upload_sanpham_l.$v['thumb']; else echo 'images/noimage.gif';?>" alt="" /></a>
								</div>
								<div class="product-name">
									<a href="<?=$com?>/<?php echo $v['id']."/".$v['tenkhongdau']?>.html" title="<?php echo $v['ten_'.$lang]?>"><?php echo $v['ten_'.$lang]?></a>
								</div>
								<div class="product-price">
									 <?php if($v['gia'])echo number_format($v['gia'],0, ',', '.').' vnđ';else  echo '<a href="contact.html">'._contact.'</a>'; ?>
								</div>
								
								<div class="clearfix"></div>
								</div>
							</div><!-- product-item -->
							
							<?php 	
							}
						
						?>
							
							<div class="clearfix"></div>
							</div>








 <div class="phantrang" ><?=$paging['paging']?></div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
</div>

<script language="javascript">
	function addtocart(pid){
		document.form1.productid.value=pid;
		document.form1.command.value='add';
		document.form1.submit();
	}
</script>

<form name="form1" action="index.php">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>

			