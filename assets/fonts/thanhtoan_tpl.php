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
<script type="text/javascript">
  function isNumberKey(evt)
 {
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
 return false;
 return true;
 }
 
</script>
<div class="block_content">
    <div class="title_index"><h2 class="title-pro-new"><span><?=$title_tcat?></span></h2></div>
    <div class="clear"></div>
    <div class="show-pro">
        <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size: 11px; color:#101010; border-collapse: collapse;" width="100%">
          <?php
			if(is_array(@$_SESSION['cart'])){
            	echo '<tr bgcolor="#29702b" style="font-weight:bold;color:#fff;height: 25px;">
						<td align="center" style="padding:10px">STT</td>
						<td align="center">Tên</td>
						<td align="center">Giá</td>
						<td align="center" style="display:none">Khuyến mãi</td>
						
						<td align="center">Số lượng</td>
						<td align="center">Quy cách</td>
						<td align="center">Tổng giá</td>
					</tr>';
			/**
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];				
					$pname=get_product_name($pid);
					if($q==0) continue;
					if(get_price_km($pid)>0) $gia=get_price_km($pid);
					else $gia=get_price($pid);*/
					$max=count($_SESSION['cart']);
					$total  = 0;
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];	
					if($pid==-1){
						$pname=$_SESSION['cart'][$i]['tentam'];	
						$quycach='';
					}else{
						$pname=get_product_name($pid);
						$quycach=get_product_quycach($pid);
					}
					if($q==0) continue;
					
					$gia = renderPrice($pid);
					if($gia){
						$total+=$gia*$q;
					}
					
					
					
			?>
           
          <tr bgcolor="#FFFFFF" style="text-align: center; border-top:1px solid #CCC">
            <td width="8%" align="center" style="height: 25px; padding:10px"><?=$i+1?></td>
            <td width="20%"><?=$pname?></td>
            <td width="15%" align="center">
			<?=($gia) ? myformat($gia) : 'Liên hệ' ?>
				
            </td>
            <td width="15%;" style="display:none" align="center"><?=number_format(get_price_km($pid),0, ',', '.')?></td>
            <td width="15%" align="center"><input type="text" readonly="readonly" name="product<?=$pid?>" value="<?=$q?>" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0" />
              &nbsp;</td>
            <td width="15%" align="center"><?=$quycach?></td>  
            <td width="15%" align="center" style="color:#F00">
			<?=($gia) ? myformat($gia*$q) : 'Liên hệ' ?>
            </td>
          </tr>
          <?php					
				}
			?>
          <tr>
            <td colspan="7" style="background:#E6E6E6; height:20px; color: #666; padding:10px"><b>Tổng đơn hàng:
              <span style="color: #F60;">&nbsp;&nbsp;&nbsp;
			  <?=myformat($total);?>
				</span>
              </td>

          </tr>
          <?php
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td style='padding:10px'>Không có sản phẩm nào trong giỏ hàng!</td></tr>";
			}
		?>
        </table>
        <div class="text" style="padding:0 10px;">
            <form method="post" name="frm_order" action="" enctype="multipart/form-data" onsubmit="return check();">
              <table width="100%" cellpadding="5" border="0" class="tablelienhe" cellspacing="10">
                <tr>
                  <td colspan="2"><b>Thông tin khách hàng</b></td>
                </tr>
                <tr>
                  <td>Họ tên<span>*</span></td>
                  <td><input name="ten" id="ten" class="input" value="<?=@$_POST['ten']?>" /></td>
                </tr>
                <tr>
                  <td>Điện thoại<span>*</span></td>
                  <td><input name="dienthoai" id="dienthoai" class="input" value="<?=@$_POST['dienthoai']?>" onKeyPress="return isNumberKey(event)"/></td>
                </tr>
                <tr>
                  <td>Địa chỉ<span>*</span></td>
                  <td><input  name="diachi"  id="diachi" class="input"  value="<?=@$_POST['diachi']?>"/></td>
                </tr>
                <tr>
                  <td>E-mail<span>*</span></td>
                  <td><input name="email" id="email" class="input"  value="<?=@$_POST['email']?>"/></td>
                </tr>
                <tr>
                  <td>Nội dung</td>
                  <td><textarea name="noidung"  cols="50" rows="5"  ><?=@$_POST['noidung']?>
        </textarea></td>
                </tr>
                <!--<tr>
                  <td colspan="2"><b>Hình thức thanh toán</b></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="radio" name="httt" value="1" checked="checked" />
                    Thanh toán trực tiếp<br/>
                    <input type="radio" name="httt" value="2" />
                    Thanh toán qua ngân lượng </td>
                </tr>-->
              </table>
              <div style="text-align: right; padding-top:20px; width: 435px;">
                <input title='tiếp tục' class="button" type="submit" name="next" value="Xác nhận" style="cursor:pointer;"/>
              </div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>