<h3>Thêm danh mục</h3>

<form name="frm" method="post" action="index.php?com=about&act=download" enctype="multipart/form-data" class="nhaplieu"> 

	<b>File cũ:</b><a href="<?=_upload_hinhanh.$item['url']?>" target="_new"><?=$item['url']?></a><br />

	<b>Chọn file:</b> <input type="file" name="file" /> doc|ppt|xls|pdf|docx|pptx|xlsx|PDF|rar|win<br />
    <br />	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" name="submit"/>
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn" />
</form>