<?php  if(!defined('_source')) die("Error");		
	// thanh tieu de
	$title_bar .= "Thanh toán - ";
	

	
	if(!empty($_POST)){
		
		$hoten=$_POST['ten'];
		$dienthoai=$_POST['dienthoai'];
		$diachi=$_POST['diachi'];
		$email=$_POST['email'];
		$noidung=$_POST['noidung'];
		$httt=$_POST['httt'];	
		
		//validate dữ liệu
	
	$hoten = trim(strip_tags($hoten));
	$dienthoai = trim(strip_tags($dienthoai));	
	$diachi = trim(strip_tags($diachi));	
	$email = trim(strip_tags($email));	
	$noidung = trim(strip_tags($noidung));	
	settype($httt,"int");

	if (get_magic_quotes_gpc()==false) {
		$hoten = mysql_real_escape_string($hoten);
		$dienthoai = mysql_real_escape_string($dienthoai);
		$diachi = mysql_real_escape_string($diachi);
		$email = mysql_real_escape_string($email);
		$noidung = mysql_real_escape_string($noidung);						
	}
	$coloi=false;		
	if ($hoten == NULL) { 
		$coloi=true; $error_hoten = "Bạn chưa nhập họ tên<br>";
	} 
	if ($dienthoai == NULL) { 
		$coloi=true; $error_dienthoai = "Bạn chưa nhập điện thoại<br>";
	}
	if ($diachi == NULL) { 
		$coloi=true; $error_diachi = "Bạn chưa nhập địa chỉ<br>";
	}	
	
	if ($email == NULL) { 
		$coloi=true; $error_email = "Bạn chưa nhập email<br>";
	}elseif (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
		$coloi=true; $error_email="Bạn nhập email không đúng<br>";
	}
	if ($httt <1 and $httt>2) { 
		$coloi=true; $error_httt = "Bạn chưa chọn hình thức thanh toán<br>";
	}
	
	if ($coloi==FALSE) {
										
			 
			if(is_array($_SESSION['cart']))
			{
					$body = ' <table id="giohang" class="table table-bordered " style="margin-top:10px">';
                    if(is_array($_SESSION['cart'])){
                    $body .= '<thead><th align="center"></th><th>'._pname.'</th><th align="center">'._price.'</th><th align="center">'._quantity.'</th><th align="center">'._total_price.'</th></thead>';
                    foreach($_SESSION['cart'] as $k=>$v){
					$code  =$k;
                    $pid=$v['productid'];
                    $q=$v['qty'];					
                    $color = $v['color'];
                    $size = $v['size'];
                    $info=getProductInfo($pid);
                    $pname=get_product_name($pid);
                    $image = $config_url."/"._upload_sanpham_l.$info['thumb'];
                    if($color){
                    $img = getProductThumbnailWidthColor($pid,$color);
                    if($img){
                    $image = $config_url.$img;
                    }
                    }
                    if($q==0) continue;
                  
                     $body .='<tr bgcolor="#FFFFFF"><td width="10%" align="center"><a target="_blank"  href="'.$config_url.'san-pham/'.$info['id'].'/'.$info['tenkhongdau'].'.html"><img src="'.$image.'" class="img-responsive" /></a></td>';
                     $body .='<td width="35%"><a target="_blank" href="'.$config_url.'san-pham/'.$info['id'].'/'.$info['tenkhongdau'].'.html">'.$pname.'</a>';
					if ($color) {
					$colors = getColorByProductId($pid);
					 $body .= '<div class="product-option"><label>Màu sắc: </label>';
    
    foreach ($colors as $k2 => $v2) {
		if($v2['id_color'] == $color){
			$body .= "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
$body .='<div class="clearfix"></div></div>';
}
if ($size) {
    $sizes = getSizeByProductId($pid);
    $body .= '<div class="product-option"><label>Kích thước: </label>';
   
    foreach ($sizes as $k2 => $v2) {
        if($v2['id_size'] == $size){
			$body .= "<strong class='red'>".$v2['ten']."</strong>";
		}
    }
   

    $body .='<div class="clearfix"></div></div>';
}
                      $body .= '</td>';
                       $body .= '<td width="10%" align="center">';
                           
                            if ($info['giacu'] > 0) {
                              $body .='<div class="price-old">' . myformat($info['giacu']) . '</div>';
                            }
                            $body .='<div class="price-real">' . myformat($info['gia']) . '</div>';
                           
                       $body .= '<td width="10%" align="center"><input type="text" name="product['.$code.']" value="'.$q.'" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;</td>';                    
                        $body .='<td width="18%" align="center" class="price-total">'.number_format(get_price($pid) * $q, 0, ',', '.').'&nbsp;VNĐ</td>';
                       
                      $body .='</tr>';
}
                     $body .=' <tr><td colspan="6" style="padding:0">';
                           $body .='<h3 class="all-cart-price">'._total_price.':'.number_format(get_order_total(), 0, ',', '.').'&nbsp;VNĐ</h3>';
                       $body .='   </td></tr>';
                   
                    
                    }
                    
                 $body .=' </table>	';
				
			$mahoadon=strtoupper (ChuoiNgauNhien(6));
			$ngaydangky=time();
			$tonggia=get_order_total();
			
			$sql = "INSERT INTO  table_donhang (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,noidung,donhang,ngaytao,tinhtrang ) 
				  VALUES ('$mahoadon','$hoten','$dienthoai','$diachi','$email','$httt','$tonggia','$noidung','".magic_quote($body)."','$ngaydangky','1')";	
				mysql_query($sql) or die(mysql_error());
			$iduser = mysql_insert_id();
			
			
				unset($_SESSION['cart']);
				 transfer("Đơn hàng của bạn đã được gửi", "index.html");
			}
			
	}
	}
	
