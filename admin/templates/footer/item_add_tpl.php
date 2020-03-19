<h3>Thông tin liên hệ</h3>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal">   
<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=save'" class="btn btn-warning" />
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
				<p><button class="btn btn-success btn-mini" id="add-add">Thêm địa chỉ</button></p>
				<div class="parent">
					<?php 
						foreach(json_decode($item['address']) as $k2=>$v2){
							echo '<p><div class="col-sm-12"><textarea  name="add[]" class="form-control editor mini" id="'.$k2.'" >'.$v2.'</textarea></div></p><div class="clearfix"></div>';
						
						
						}
					
					
					?>
				
				</div>
				
				
				
				
				
				<script>
					$().ready(function(){
						$("#add-add").click(function(){
							$id = "nd_"+(Math.random()*100);
							$content = '<p><div class="col-sm-12"><textarea  name="add[]" class="form-control editor mini" id="'+$id+'" ></textarea></div></p><div class="clearfix"></div>';
							$(".parent").append($content);
							
							setupFullEditor($id,true);
							return false;
						})
					
					
					})
				
			
				</script>
			</div>
		<div class="clearfix"></div>
		<?php }  ?>
		<div class="clearfix"></div>
		
	</div>

</form>