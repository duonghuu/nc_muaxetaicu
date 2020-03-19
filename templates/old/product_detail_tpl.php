
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

<div id="gallery">
<div class="tieude_giua" >Chi tiết sản phẩm</div>
<div class="box_containerlienhe" style="padding:10px;">
	<div class="chitietsanpham">
          <div class="product_detail_pic"><a class="phongto"  href="<?=_upload_sanpham_l.$row_detail['photo']?>" rel="lightbox[plants]" title="<?=$row_detail['ten']?>"><img src="<?=_upload_sanpham_l.$row_detail['photo']?>" /></a>
          </div>
            <ul class="product_info" style="padding:10px; line-height:1.8em;">
                <li><a class="addfont" style="color:#e78953; font-weight:bold; font-size:17px;"><?=$row_detail['ten']?></a></li>
                 <li><b>Mã sản phẩm:</b> <?=$row_detail['maso']?></span></li>
                 <li><b>Giá bán: <span style="color:#F00;"><?php if($row_detail['giaban']!=NULL)echo $row_detail['giaban'];else echo 'Liên hệ'?></span></b></li>                  
                 <li><b>Lượt xem:</b> <span><?=$row_detail['luotxem']?></span></li> 
                 <li><?=$row_detail['mota']?></li> 
                 <li>
                 <a class="xemgio" href="gio-hang.html" style="cursor:pointer;">Xem giỏ</a>
                 <a class="giohang" onclick="addtocart(<?=$row_detail['id']?>)" style="cursor:pointer;">Đặt hàng</a>
                 </li>
                 
                  <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style" style="float:right;">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                <a class="addthis_counter addthis_pill_style"></a>
                </div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
                <!-- AddThis Button END -->
                
                 <div class="clear"></div>           
              </ul>
              <?php if($row_detail['noidung']!=NULL) { ?>
                  <h2>Thông tin sản phẩm</h2><br />
                  <?=$row_detail['noidung']?>
              <?php } ?>
  </div><!--.chitietsanpham-->      
   
<div class="clear"></div>
</div><!--.box_containerlienhe-->


<div class="tieude_giua">Sản phẩm cùng loại</div>
<div class="wap_item">
	<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){	?>
    <div class="item">
         <a href="san-pham/<?=$product[$i]['id']?>/<?=$product[$i]['tenkhongdau']?>.html">
           
            <img src="<?php if($product[$i]['thumb']!=NULL) echo _upload_sanpham_l.$product[$i]['thumb']; else echo 'images/noimage.gif';?>" onmouseover="doTooltip(event, '<?=_upload_sanpham_l.$product[$i]['photo']?>')" onmouseout="hideTip()" />
             <h3><?=$product[$i]['ten']?></h3>
        </a>
        <h4>Giá: <span><?php if($product[$i]['gia']!='')echo number_format($product[$i]['gia'],0, ',', '.').' VNĐ';else echo 'Liên hệ' ?></span></h4>
        <a><img src="images/dathang.png" onclick="addtocart(<?=$product[$i]['id']?>)" style="cursor:pointer;" class="dathang"/></a>
    </div><!---END .item-->
    <?php } ?>
    <?php if(($i+1)%3==0) echo '<div class="clear"></div>';?>
    <div class="clear"></div>
    <div class="phantrang" ><?=$paging['paging']?></div>
</div><!---END .wap_item-->

</div>
