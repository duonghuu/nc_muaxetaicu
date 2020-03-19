<h3>Hỗ trợ trực tuyến</h3>

<form name="frm" method="post" action="index.php?com=yahoo&act=save" enctype="multipart/form-data" class="nhaplieu">

	<b>Tên </b> 
	<input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br />
	
	<b>Yahoo </b>
	<input type="text" name="yahoo" value="<?=@$item['yahoo']?>" class="input" /><br /> <br />
    
   <b>Skype </b>
	<input type="text" name="skype" value="<?=@$item['skype']?>" class="input" /><br /> <br />
   
    <b>Điện thoại </b>
	<input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input" /><br /> <br />
	  <b>Email </b>
	<input type="text" name="email" value="<?=@$item['email']?>" class="input" /><br /> <br />
	
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:$stt?>" style="width:30px"><br> 
	
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=yahoo&act=man'" class="btn" />
</form>