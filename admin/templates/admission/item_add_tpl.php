<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa admission</h3> <?php }else{ ?><h3>Thêm admission</h3><?php } ?>
<?php
function get_main_item()
	{
		$sql_huyen="select * from table_admission_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>
<form name="frm" method="post" action="index.php?com=admission&act=save" enctype="multipart/form-data" class="nhaplieu">
	
    
    <?php if (@$_REQUEST['act']=='edit') { ?>
	<b>File hiện tại:</b><a target="_new" href="<?=_upload_file.$item['url']?>"><?=$item['url']?></a><br />
	<?php }?><br />
    
	<b>File:</b> <input type="file" onchange="checkExtension(this);" name="file" /><strong><?=_admission_type?></strong><br /><br /> 
	
	<div id="adding-file">
		
	</div>
    
	<b>Tiêu đề EN</b> <input type="text" name="ten_en" value="<?=@$item['ten_en']?>" class="input" /><br /><br />
	<b>Tiêu đề VI</b> <input type="text" name="ten_vi" value="<?=@$item['ten_vi']?>" class="input" /><br /><br />
  	
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br><br/>
	
  
    
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=admission&act=man'" class="btn" />
</form>
<script>
	$().ready(function(){
		$(".add-file").click(function(){
			$content = '<b>File:</b> <input type="file" onchange="checkExtension(this);" name="file" /><strong><?=_admission_type?></strong><br /><br /> ';
			$("#adding-file").append($content);
			return false;
		})
	})
	function checkExtension(obj){
		obj = $(obj);
			var ext = obj.val().match(/\.([^\.]+)$/)[1];
			switch(ext)
			{
				case 'doc':
				case 'docx':
				case 'pdf':
				case 'xls':
				case 'xlsx':
					break;
				default:
					alert('not allowed');
					obj.val("");
			}
		}
	
</script>