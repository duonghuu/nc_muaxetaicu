<h3> Cập nhật camera</h3>

<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="col-xs-6">
	<div class="form-group">
    <label for="exampleInputEmail1">Mật khẩu</label>
	 <input type="text" class="form-control"  name="password" value="<?=@$item['password']?>" class="input" />
    
	</div>
	<div class="form-group">
    <label for="exampleInputEmail1">Camera link</label>
	<p>  <button type="submit" class="btn btn-default add-cmr">Thêm link</button></p>
    
	</div>
	<div id="camera">
			<?php
				$c = json_decode($item['link']);
				foreach($c as $k=>$v){
					echo '<p><div class="input-group col-xs-8"><input type="text" name="links[]" value="'.$v.'" class="form-control" ><span class="input-group-btn"><button onclick="$(this).parent().parent().remove();"  class=" btn ">Xóa</button> </span></div></p>';
				}
			
			
			?>
	</div>
	
	
	
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=title&act=capnhat'" class="btn" />
</form>
<script>
	$().ready(function(){
		$(".add-cmr").click(function(){
			$content = '<p><div class="input-group col-xs-8"><input type="text" name="links[]" value="" class="form-control" ><span class="input-group-btn"><button onclick="$(this).parent().parent().remove();"  class=" btn ">Xóa</button> </span></div></p>';
			$('#camera').append($content);
			return false;
		})
	})
</script>