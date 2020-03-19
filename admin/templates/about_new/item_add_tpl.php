
<h3>Thêm giới thiệu</h3>
<?php
function get_main_item()
	{
		$sql_huyen="select * from table_news_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="nhaplieu"> 
<?php if (@$_REQUEST['act']=='edit')
	{?>
	<b>Hình hiện tại:</b><img src="<?=_upload_tintuc.$item['thumb1']?>" alt="NO PHOTO"  width="150"/><br />
	<?php }?>
    <br />
	<b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br />
	<b>Tiêu đề VN</b> <input type="text" name="ten_vi" value="<?=@$item['ten_vi']?>" class="input" /><br />	
	<b>Tiêu đề EN</b> <input type="text" name="ten_en" value="<?=@$item['ten_en']?>" class="input" /><br />	
	
	<b>Mô tả VN</b> <div> <textarea name="mota_vi" cols="50" rows="5" id="mota_vi"><?=@$item['mota_vi']?></textarea> </div>
     <b>Mô tả EN</b> <div> <textarea name="mota_en" cols="50" rows="5" id="mota_en"><?=@$item['mota_en']?></textarea> </div>
	
    <b>Nội dung VN</b><br/><div> <textarea class="editor" name="noidung_vi" id="noidung_vi"><?=@$item['noidung_vi']?></textarea></div>
	<b>Nội dung EN</b><br/><div> <textarea class="editor" name="noidung_en" id="noidung_en"><?=@$item['noidung_en']?></textarea></div>
	
     
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br>
	
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn" />
</form>