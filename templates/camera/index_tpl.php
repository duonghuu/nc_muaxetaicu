<div class="box_containerlienhe">
<div class="title-global"><h2>Camera</h2></div>
<div class="form-camera">
<?php
	if(!$is_view){?>
			
	<form role="form" method="post">
	<div class="label-form">Vui lòng nhập mật khẩu</div>
	<div class="clearfix"></div>
  <div class="form-group">
    
    <input type="text" name="password"	class="form-control" autocomplete="off" name="password" id="exampleInputEmail1" placeholder="Enter password" required>
  </div>
 
  <button type="submit" name="submit" class="btn btn-default btn-success">Xem camera</button>
</form>
	<?php } else {
		$link = json_decode($result['link']);
		echo '<table class="table table-bordered">';
		echo '<thead><th>STT</th><th>Đường dẫn</th></thead>';
		foreach($link as $k=>$v){
			
			echo '<tr><td>'.($k+1).'</td><td><a href="'.$v.'">'.$v.'</a></td></tr>';

		}
		echo '</table>';
	
	}



?>
</div>
</div>
<style>
.form-camera{width:600px;margin:20px auto;color:#111;text-align:center;}
.form-camera .label-form{width:100%;font-weight:bold;font-size:17px;margin-bottom:20px}
</style>