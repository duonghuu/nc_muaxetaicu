<?php

function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	?>
<h3>Chi tiết đơn hàng</h3>

<form name="frm" method="post" action="index.php?com=order&act=save" enctype="multipart/form-data" class="nhaplieu">
<table class="table-bordered">
	<tr>
		<td>
			Mã đơn hàng
		</td>
		<td>
			<strong><?=@$item['madonhang']?></strong>
		</td>
<tr>		
    <td>Họ tên</td><td></b><strong><?=@$item['hoten']?></strong></td></tr>
   <tr>     <td>Điện thoại: </td><td><strong><?=@$item['dienthoai']?></strong></td>	</tr>	  
     <tr>   <td>Email: </td><td><strong><?=@$item['email']?></strong></td>	</tr>	  
    <tr>   <td>     Địa chỉ:</td><td><strong><?=@$item['diachi']?></strong>	</td></tr>  
			
</table>			
    <div>
    
	<?php 
		echo @$item['donhang'];
	
	?>

	

    
    
  </div>
	
	<b>Nội dung thêm:</b><br/>
	<div>
	<?=$item['noidung']?></div>	
    <br/>
    <b>Ghi chú</b>
     <textarea name="ghichu" cols="50" rows="5" id="ghichu"><?=@$item['ghichu']?></textarea><br/>
     <b>Tình trạng</b><?=tinhtrang($item['tinhtrang'])?><br/>
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=order&act=man'" class="btn" />
</form>