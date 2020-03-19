

<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa <?=$_GET['com']?></h3> <?php }else{ ?><h3>Thêm <?=$_GET['com']?></h3><?php } ?>
<?php
function get_main_item()
	{
		$sql_huyen="select * from table_gallery_item order by stt,id desc ";
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
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal " role="form">
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<div class='clearfix'></div>
	<p></p>
   <div class="col-xs-10">
  <div class="row">
  
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	<?php if($_GET['com']!='hd'){?>
	<div class="col-xs-6">
		<div class="col-xs-12">
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">Hình đại diện</label>
				   <div class="input-group">
				 <input type="file" name="file" />
				  
				</div>
				<a class="fancybox"  href="<?=_upload_tintuc.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_tintuc.@$item['photo']?>" class="col-xs-4" /></a>
			 </div>
		 </div>
	 </div>
	 <!-- <div class="col-xs-6 align-left">
		<div class="col-xs-12">
			 <div class="checkbox">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div>
			  <div class="checkbox">
				<label>
				  <input type="checkbox"  name="noibat" <?=(!isset($item['noibat']) || $item['noibat']==1)?'checked="checked"':''?>> Nỗi bật
				</label>
			  </div>
			  <div class="col-xs-12">
			  <div class="row">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 align-left control-label">Số thứ tự</label>
					<div class="col-sm-8">
					  <input type="text" name="stt"  value="<?=(@$stt) ? $stt : @$item['stt']?>" class="form-control w-120 " id="inputEmail3">
					</div>
				 </div>
			</div>	 
			</div>
		 </div>
	 </div>-->
	 <?php } ?>
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
	<li class=""><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
	</ul>

	<div class="tab-content">
	
	<?php
		foreach($config['lang'] as $k=>$v){?>
			
		<?php $act = ''; if($k==0){ $act = 'active'; }?>
		
		 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		<?php if($_GET['com']!='hd'){?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
			<div class="col-sm-10">
			  <input type="text" name="ten_<?=$v?>" value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
			</div>
		 </div>
		<button id="add-image">Thêm hình</button>
		<p></p>
		<div class="col-xs-12">
		<div id="gal-container">
		<?php
			foreach(json_decode(@$item['gallery']) as $k=>$v){
				$link = $v->link;
				$desc = $v->desc;
				
				$id = md5(time()).$k;
			?>
					<div><div class="form-group form-group-sm"><div class="col-sm-6 input-group input-group-sm"><span class="input-group-addon"><a onclick="viewFcb('<?=$id?>');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="photos[]" placeholder="Link hình" value="<?=$link?>" class="form-control main-image" id="<?=$id?>"><span class="input-group-btn"> <button type="submit" data-for="<?=$id?>" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary " onclick="$(this).parent().parent().parent().parent().remove();">Xóa</button></span></div><div class="col-sm-6" style="margin-top:-1px"><div class="row"><input type="text" placeholder="Mô tả" name="desc[]" value="<?=$desc?>" class="form-control form-control-sm " id=""></div></div></div><div class="clearfix"></div></div>
			<?php }
			$v = "";
		?>	
		</div><!-- end gal-container -->
		</div>
			
		<div class="clearfix"></div> 
		 
		 
		 
		 
		 
		<!-- 
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
			<div class="col-sm-10">
			  <textarea  name="mota_<?=$v?>" class="form-control" id="inputEmail3" ><?=@$item['mota_'.$v]?></textarea>
			</div>
		</div>
		<?php } ?>
		<div class="clearfix"></div>
		<div class="form-group">
			<p><label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label></p>
			<div class="clearfix"></div>
			<p></p>
			<div class="col-sm-12">
			  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
			</div>
		</div>
		-->
		
		
		<div class="clearfix"></div>
		 </div>
	<?php } ?>
	<?php include _template."seo_tpl.php"?>
	</div>
	</div>	
</div></div><!-- content-tab --><div class="clearfix"></div>
</form>
<script>
		$().ready(function(){
			
			$("#add-image").click(function(){
			$id = makeid();
			$content = '<div><div class="form-group form-group-sm">';
			$content += '<div class="col-sm-6 input-group input-group-sm"><span class="input-group-addon"><a onclick="viewFcb(\''+$id+'\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="photos[]" placeholder="Link hình" value="" class="form-control main-image" id="'+$id+'"><span class="input-group-btn"> <button type="submit" data-for="'+$id+'" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary " onclick="$(this).parent().parent().parent().parent().remove();">Xóa</button></span></div>';
			
			$content += '<div class="col-sm-6" style="margin-top:-1px"><div class="row"><input type="text" placeholder="Mô tả" name="desc[]" value="" class="form-control form-control-sm " id=""></div></div>';
			$content += '</div><div class="clearfix"></div>';
			$content += '</div>';
			$("#gal-container").append($content);
			initBrowserServer();
			return false;
			})
			$("#add-image-option").click(function(){
			$id = makeid();
			$content = '<div class="form-group"><div class="col-sm-6 input-group"><span class="input-group-addon"><a onclick="viewFcb(\''+$id+'\');return false;" class="view_fcb" id="" href="">Xem hình</a></span><input type="text" name="options[]" value="" class="form-control main-image" id="'+$id+'"><span class="input-group-btn"> <button type="submit" data-for="'+$id+'" class="show btn browser">Chọn</button></span><span class="input-group-btn"> <button class=" btn btn-primary " onclick="$(this).parent().parent().parent().remove();">Xóa</button></span></div></div>';
			$("#gal-container-option").append($content);
			initBrowserServer();
			return false;
			})
		})
		
		function viewFcb(obj){
				
			$href = base_url+$("#"+obj).val();

			$.fancybox({href:$href});
			return false;
		}
	</script><style>
.photo-side input[type=text]{
	width:300px;
}
.photo-side textarea{
	width:300px;
	height:50px;
}
.clear{clear:both}
</style>