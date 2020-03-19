<!--
<h3>Thêm <?=$com?></h3>

-->
<?php
function get_main_item()
	{
		$sql_huyen="select * from table_news_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">			
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
?>
<form name="frm" method="post" action="index.php?com=<?=$_GET['com']?>&act=save" enctype="multipart/form-data" class="form-horizontal " role="form" > 
	
  <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-10">
  <div class="row">
 
	<!-- <b>Hình ảnh:</b> <input type="file" name="file" /> <?=_news_type?><br /><br /> -->
	
	<div id="tab-content">
	
	
		<div class="col-xs-6">
			
			
			 <div class="form-group">
					<label for="inputEmail3" class="col-sm-4  control-label">Tên</label>
					<div class="col-sm-8">
						<input type="text" name="ten" value="<?=@$item['ten']?>" class="form-control " id="inputEmail3">
					  
					</div>
				 </div>
			<div class="form-group">
					<label for="inputEmail3" class="col-sm-4  control-label">Url</label>
					<div class="col-sm-8">
						<input type="text" name="link" value="<?=@$item['link']?>" class="form-control link" id="inputEmail3">
					  
					</div>
				 </div>
			<div class="form-group brimg">
				<label for="inputEmail3" class="col-sm-4 control-label">Hình ảnh</label>
				   <div class="input-group">
						<input type="file" name="file" />
				  
					</div>
				
			 </div>
			 <?php if(isset($_GET['id'])){?>
			 <div class="form-group">
			 <label for="inputEmail3" class="col-sm-4 control-label"></label>
				<a class="fancybox"  href="<?=_upload_hinhanh.@$item['photo']?>" ><img  id="main-image" src="<?=_upload_hinhanh.@$item['photo']?>" class="col-xs-4" /></a>
				
			</div>	
				<?php } ?>
			 
			 
			 
			 
				<div class="checkbox col-sm-offset-4">
				<label>
				  <input type="checkbox"  name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>> Hiển thị
				</label>
			  </div> 
			<p></p>	
			
			  <div class="form-group">
					<label for="inputEmail3" class="col-sm-4 align-left control-label">Số thứ tự</label>
					<div class="col-sm-8">
					  <input type="text" name="stt"  value="<?=(@$stt) ? $stt : @$item['stt']?>" class="form-control w-120 " id="inputEmail3">
					</div>
				 </div>
		 </div>
	
	 
	 
	 <div class="clearfix"></div>
	
	

		
		
		<div class="clearfix"></div>
		
		
		
		<div class="clearfix"></div>
		 </div>

	
	
	</div>	
</div><!-- content-tab --><div class="clearfix"></div>
<!-- Tab panes -->

	
</form>