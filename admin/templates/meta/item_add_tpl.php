<h3> Cập nhật meta cho website</h3>

<form name="frm" method="post" action="index.php?com=meta&act=save" enctype="multipart/form-data" class="nhaplieu">
	
	<b>Keyword:</b> 
	<label>
	<textarea name="keyword" id="ten" cols="45" rows="5"><?=@$item['keyword']?></textarea>
	</label>
	<br />
	<b>Description:</b> 
	<label>
	
	<textarea name="description" id="ten" cols="45" rows="5"><?=@$item['description']?></textarea>
	</label>
  <br><br />
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=meta&act=capnhat'" class="btn" />
</form>