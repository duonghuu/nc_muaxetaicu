

<h3>Thông tin liên hệ</h3>
<form name="frm" method="post" action="index.php?com=lienhe&act=save" enctype="multipart/form-data" class="form-horizontal">   
<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=capnhat'" class="btn btn-warning" />
	<p></p>	
	<ul class="nav nav-tabs">
	<?php
		foreach($config['lang'] as $k=>$v){
			$act = '';
			if($k==0){
				$act = "active";
			}
			
			echo '<li class="'.$act.'"><a href="#'.$v.'" data-toggle="tab"><strong>'.$config['AllLang'][$v].'</strong></a></li>';
			
		}
	?>
	<li ><a href="#map" data-toggle="tab"><strong>Map</strong></a></li>
	</ul>
	
	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			<?php $act = ''; if($k==0){ $act = 'active'; }?>
			<div class="tab-pane  <?=$act?>" id="<?=$v?>" >
				<div class="form-group">
				<p><label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label></p>
				<div class="clearfix"></div>
				<p></p>
				<div class="col-sm-12">
				  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
				</div>
				</div>
			</div>
		<div class="clearfix"></div>
		<?php }  ?>
			<div class="tab-pane  " id="map" >
				
				  <div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">Map toa độ X</label>
					<div class="col-sm-8">
					  <input type="text" name="map_x"  value="<?=@$item['map_x']?>" class="form-control w-120 " id="inputEmail3">
					</div>
				 </div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3  control-label">Map toa độ Y</label>
					<div class="col-sm-8">
					 <input type="text" name="map_y"  value="<?=@$item['map_y']?>" class="form-control w-120 " id="inputEmail3">
					</div>
				 </div>
			
			</div>
		<div class="clearfix"></div>
		
	</div>

</form>