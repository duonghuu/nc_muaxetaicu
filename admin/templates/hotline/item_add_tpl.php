<h3> Cập nhật thông tin Công Ty</h3>





<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal " role="form" > 

  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<?php if($com!="about") {?><input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" /><?php } ?>
	<p></p>	
  <div class="col-xs-10">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">

	
	
			  <div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 align-left control-label">Facebook</label>
					<div class="col-sm-8">
					  <input type="text" name="facebook" value="<?=@$item['facebook']?>" class="form-control" id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
			<div class="clearfix"></div>
		 
	 

	 <div class="clearfix"></div>

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
			<label for="inputEmail3" class="col-sm-2 control-label">Slogan</label>
			<div class="col-sm-10">
			  <input type="text" name="slogan_<?=$v?>" value="<?=@$item['slogan_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		 
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tên công ty</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Điện thoại</label>
			<div class="col-sm-10">
			  <input type="text" name="dienthoai_<?=$v?>" value="<?=@$item['dienthoai_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		 
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
			  <input type="text" name="email_<?=$v?>" value="<?=@$item['email_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ</label>
			<div class="col-sm-10">
			  <input type="text" name="diachi_<?=$v?>" value="<?=@$item['diachi_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		 
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Fax</label>
			<div class="col-sm-10">
			  <input type="text" name="fax_<?=$v?>" value="<?=@$item['fax_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div> 
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Hotline</label>
			<div class="col-sm-10">
			  <input type="text" name="hotline_<?=$v?>" value="<?=@$item['hotline_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		
		<div class="clearfix"></div>
		 </div>
	<?php } ?>
	
	</div>
	</div>	
</div></div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>

