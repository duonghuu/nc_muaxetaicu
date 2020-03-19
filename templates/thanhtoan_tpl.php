<link href="assets/css/cart.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
function validEmail(obj) {
	var s = obj.value;
	for (var i=0; i<s.length; i++)
		if (s.charAt(i)==" "){
			return false;
		}
	var elem, elem1;
	elem=s.split("@");
	if (elem.length!=2)	return false;

	if (elem[0].length==0 || elem[1].length==0)return false;

	if (elem[1].indexOf(".")==-1)	return false;

	elem1=elem[1].split(".");
	for (var i=0; i<elem1.length; i++)
		if (elem1[i].length==0)return false;
	return true;
}//Kiem tra dang email
function IsNumeric(sText)
{
	var ValidChars = "0123456789";
	var IsNumber=true;
	var Char;

	for (i = 0; i < sText.length && IsNumber == true; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
		{
			IsNumber = false;
		}
	}
	return IsNumber;
}//Kiem tra dang so
function check()
		{
			var frm 	= document.frm_order;
			
			if(frm.ten.value=='') 
			{ 
				alert( "Bạn chưa điền họ tên." );
				frm.ten.focus();
				return false;
			}
			if(frm.dienthoai.value=='') 
			{ 
				alert( "Bạn chưa điền điện thoại." );
				frm.dienthoai.focus();
				return false;
			}
			if(frm.diachi.value=='') 
			{ 
				alert( "Bạn chưa điền địa chỉ." );
				frm.diachi.focus();
				return false;
			}
			
			if(frm.email.value=='') 
			{ 
				alert( "Bạn chưa điền email." );
				frm.email.focus();
				return false;
			}
			if(!validEmail(frm.email)){
				alert('Vui lòng nhập đúng địa chỉ email');
				frm.email.focus();
				return false;
			}												
			frm.submit();		
		}	
</script>
<style>
	table#tt td
	{
		height:30px;
	}
	table#tt td input.t
	{
		width:300px;
		height:20px;
		margin:3px 0px 5px 0px;
		border:1px solid #DDD;
	}
	table#tt span
	{
		color:red;
x;
	}
</style>

<div class="box_containerlienhe col-xs-12 shop">
<div class="title-global"><h2><?=_payment?></h2><div class="clearfix"></div></div> 
	<div class="content">
           <table id="giohang" class="table table-bordered " style="margin-top:10px">
                    <?
                    if(is_array($_SESSION['cart'])){
                    echo '<thead><th align="center"></th><th>'._pname.'</th><th align="center">'._price.'</th><th align="center">'._quantity.'</th><th align="center">'._total_price.'</th></thead>';
                    foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
                    $image = _upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
                    $image = $config_url.$img;
                    }
                    }
                    if($q==0) continue;
                    ?>
                    <tr bgcolor="#FFFFFF"><td width="10%" align="center"><a target="_blank"  href="san-pham/<?= $info['id'] ?>/<?= $info['tenkhongdau'] ?>.html"><img src="<?= $image ?>" class='img-responsive' /></a></td>
                        <td width="35%"><a target="_blank" href="san-pham/<?= $info['id'] ?>/<?= $info['tenkhongdau'] ?>.html"><?= $pname ?></a>
<?php
if ($color) {
    $colors = getColorByProductId($pid);
    echo '<div class="product-option"><label>Màu sắc: </label>';
    
    foreach ($colors as $k2 => $v2) {
		if($v2['id_color'] == $color){
			echo "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
    echo '<div class="clearfix"></div></div>';
}
if ($size) {
    $sizes = getSizeByProductId($pid);
    echo '<div class="product-option"><label>Kích thước: </label>';
   
    foreach ($sizes as $k2 => $v2) {
        if($v2['id_size'] == $size){
			echo "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
   

    echo '<div class="clearfix"></div></div>';
}
?>


                        </td>
                        <td width="10%" align="center">
                            <?php
                            if ($info['giacu'] > 0) {
                                echo '<div class="price-old">' . myformat($info['giacu']) . '</div>';
                            }
                            echo '<div class="price-real">' . myformat($info['gia']) . '</div>';
                            ?>
                        <td width="10%" align="center"><input type="text" name="product[<?=$code?>]" value="<?= $q ?>" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;</td>                    
                        <td width="18%" align="center" class="price-total"><?= number_format(get_price($pid) * $q, 0, ',', '.') ?>&nbsp;VNĐ</td>
                       
                    </tr>
<?php
}
?>
                    <tr><td colspan="6" style="padding:0">
                            <h3 class="all-cart-price"><?= _total_price ?>: <?= number_format(get_order_total(), 0, ',', '.') ?>&nbsp;VNĐ</h3>
                        </td></tr>
                   
                    <?
                    }
                    else{
                    echo "<tr bgColor='#FFFFFF'><td class='empty'>Không có sản phẩm nào trong giỏ hàng!</td>";
                    }
                    ?>
                </table>	
		<h4><?=_cus_info?></h4>
    <form method="post" class="form-horizontal" name="frm_order" action="" enctype="multipart/form-data" role="form" onsubmit="return check();">          
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label"><?=_fullname?><span>*</span></label>
			<div class="col-sm-9">
				<input class="t form-control" name="ten" id="ten" required value="<?=@$_POST['ten']?>" />
			
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label"><?=_phone?><span>*</span></label>
			<div class="col-sm-9">
				<input class="t form-control" name="dienthoai" id="dienthoai" required  value="<?=@$_POST['dienthoai']?>" />
			
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label" ><?=_address?><span>*</span></label>
			<div class="col-sm-9">
				<input class="t form-control" name="diachi"  id="diachi" required value="<?=@$_POST['diachi']?>" />
			
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">E-Mail<span>*</span></label>
			<div class="col-sm-9">
				<input class="t form-control" name="email" id="email" type="email" required value="<?=@$_POST['email']?>" />
			
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label"><?=_content?><span>*</span></label>
			<div class="col-sm-9">
				
				<textarea name="noidung" class="form-control" cols="50" required rows="5"  ><?=@$_POST['noidung']?></textarea>
			
			</div>
		</div>
	

    <div style="text-align: right; padding-top:20px;">
      
        <input title='tiếp tục' class="btn" type="submit" name="next" value="<?=_continue?>" style="cursor:pointer;"/>  
    </div>
      </form>
      
      <?=$huongdanthanhtoan['noidung']?>
            
 </div>  
 </div>