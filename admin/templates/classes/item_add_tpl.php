

<h3>Lớp học</h3>
<form name="frm" method="post" action="index.php?com=classes&act=save" enctype="multipart/form-data" class="nhaplieu">  

     <b>Nội dung EN</b><br/>
	<div>
	 <textarea name="noidung_en" class="editor" id="noidung_en"><?=$item['noidung_en']?></textarea></div>
	 <b>Nội dung VI</b><br/>
	<div>
	 <textarea name="noidung_vi" class="editor" id="noidung_vi"><?=$item['noidung_vi']?></textarea></div>
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=classes&act=capnhat'" class="btn" />
</form>