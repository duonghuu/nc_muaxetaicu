
<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa sản phẩm</h3> <?php }else{ ?><h3>Thêm sản phẩm</h3><?php } ?>
<script language="javascript">				
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=product&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=product&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=product&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}

	
</script>
<?php
function get_main_danhmuc()
	{
		$sql="select * from table_product_danhmuc order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="main_font form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
		}
		$str.='</select>';
		return $str;
	}

function get_main_list()
	{
		$sql="select * from table_product_list where id_danhmuc=".@$_REQUEST['id_danhmuc']."  order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_font form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_main_category()
	{
		$sql="select * from table_product_cat where id_list=".$_REQUEST['id_list']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_cat" name="id_cat" onchange="select_onchange2()" class="main_font form-control">
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_i"].'</option>';
		}
		$str.='</select>';
		return $str;
	}
	
	
	/* function get_main_item()
	{
		$sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" class="form-control">
			<option>Chọn danh mục</option>			
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
	} */
?>









<form name="frm" method="post" action="index.php?com=product&act=save&curPage=<?=@$_REQUEST['curPage']?>" enctype="multipart/form-data" class="form-horizontal" >	 




 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn  btn-success" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=<?=$_GET['com']?>&act=man'" class="btn btn-warning" />
	<p></p>	
  <div class="col-xs-12">
  


<div class="panel panel-info">

  <div class="panel-body">
 
 <div class="col-xs-6">
	<div class="row">
 <?=get_main_item2(@$item,1) ?>
<?php /*initList("Loại phòng","id_loaiphong","loaiphong",@$item['id_loaiphong']) */?>
 

	
			 <!--
			  <div class="form-group">
			 <label for="inputEmail3" class="col-sm-4  control-label">Danh mục cấp 2:</label>
			 <div class="col-sm-6">	
				<?=get_main_list();?>
			 </div>
			 </div>-->
			 <div class="col-xs-12">
		<div class="form-group"><label for="" class="col-sm-3 control-label">Hình ảnh:</label> <div class="col-sm-6">
		 <input type="file" name="file" />
		 <?php if($_GET['act'] == 'edit'){?>
		 <p></p>
				<p>
				<a class="fancybox"  href="<?=_upload_sanpham.@$item['thumb']?>" ><img  id="main-image" src="<?=_upload_sanpham.@$item['thumb']?>" class="col-xs-10" /></a>
				</p>
				<?php } ?>
		</div></div>
		</div>
		
			 
			</div></div>
 <div class="col-xs-6">
	<div class="row">
			 
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4  control-label">Mã sản phẩm</label>
		<div class="col-sm-6">
		
		  <input type="text" name="maso"  value="<?=@$item['maso']?>" class="form-control  " id="inputEmail3">
		</div>
	</div>
	<!--
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-4  control-label">Chất liệu</label>
		<div class="col-sm-6">
		
		  <input type="text" name="chatlieu"  value="<?=@$item['chatlieu']?>" class="form-control  " id="inputEmail3">
		</div>
	</div>
<div class="form-group">
		<label for="inputEmail3" class="col-sm-4  control-label">Kích thước</label>
		<div class="col-sm-6">
		
		  <input type="text" name="kichthuoc"  value="<?=@$item['kichthuoc']?>" class="form-control  " id="inputEmail3">
		</div>
	</div>
-->

			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-4  control-label">Giá cũ</label>
				<div class="col-sm-6">
				
				  <input type="text" name="giacu"  value="<?=@$item['giacu']?>" class="form-control  " id="inputEmail3">
				</div>
		</div>
	
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-4  control-label">Giá</label>
				<div class="col-sm-6">
				
				  <input type="text" name="gia"  value="<?=@$item['gia']?>" class="form-control  " id="inputEmail3">
				</div>
		</div>
		<!--
		<div class="form-group">
				<label for="inputEmail3" class="col-sm-4  control-label">Xuất sứ</label>
				<div class="col-sm-6">
				
				  <input type="text" name="xuatsu"  value="<?=@$item['xuatsu']?>" class="form-control  " id="inputEmail3">
				</div>
		</div> -->
		<div class="form-group">
				<label for="inputEmail3" class="col-sm-4  control-label">Số thứ tự</label>
				<div class="col-sm-6">
				  <input type="text" name="stt"  value="<?=(@$stt) ? $stt : @$item['stt']?>" class="form-control w-120 " id="inputEmail3">
				</div>
		</div>
		
		<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
		  <div class="checkbox">
			<label>
			  <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> /> Hiển thị
			</label>
		  </div>
		</div>
		 <div class="form-group hide">
			<label for="" class="col-sm-4 control-label">Tài liệu:</label>
			<div class="col-sm-6">
			 <input type="file" name="download" />
			 <?php if($_GET['act'] == 'edit'){?>
			 <p></p>
					<p>
					<a class="fancybox"  href="<?=_upload_sanpham.@$item['download']?>" ><?=@$item['download']?></a>
					</p>
					<?php } ?>
			</div>
		</div>
		
		<div class="col-sm-offset-4 col-sm-8 hide">
		  <div class="checkbox">
			<label>
			  <input type="checkbox" name="hot" <?=(@$item['hot']==1)?'checked="checked"':''?> /> Sản phẩm hot
			</label>
		  </div>
		</div>
		
		<div class="col-sm-offset-4 col-sm-8">
		  <div class="checkbox">
			<label>
			  <input type="checkbox" name="noibat" <?=(@$item['noibat']==1)?'checked="checked"':''?> />Sản phẩm nổi bật
			</label>
		  </div>
		</div>
		
		<div class="col-sm-offset-4 col-sm-8 ">
		  <div class="checkbox">
			<label>
			  <input type="checkbox" name="spmoi" <?=(@$item['spmoi']==1)?'checked="checked"':''?> />Sản phẩm mới
			</label>
		  </div>
		</div>
		<div class="col-sm-offset-4 col-sm-8 hide">
		  <div class="checkbox">
			<label>
			  <input type="checkbox" name="spbanchay" <?=(@$item['spbanchay']==1)?'checked="checked"':''?> />Sản phẩm bán chạy
			</label>
		  </div>
		</div>
	  </div>
		
		</div></div>
  
  </div>
</div>
  
		
			

	
			
		
			
			 
			 
			 
			
			
	
	
	 <div class="clearfix"></div>
	<div class="col-xs-10">
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
		<li class="hide"><a href="#color" data-toggle="tab"><strong>Màu sắc</strong></a></li>
		<li class="hide"><a href="#size" data-toggle="tab"><strong>Kích thước</strong></a></li>
	 	<li class=""><a href="#gallery" data-toggle="tab"><strong>Gallery</strong></a></li>
		<!--<li class="'.$act.'"><a href="#option" data-toggle="tab"><strong>Tùy chọn</strong></a></li>-->
		
		<li class=""><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
		
	</ul>

	<div class="tab-content">
	
		<?php
			foreach($config['lang'] as $k=>$v){?>
				
			<?php $act = '';$required = ''; if($k==0){ $act = 'active'; $required="required";}?>
			
			 <div class="tab-pane  <?=$act?>" id="<?=$v?>" >
		
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
				<div class="col-sm-8">
				  <input type="text" name="ten_<?=$v?>" <?=$required?> value="<?=@$item['ten_'.$v]?>" class="form-control " id="inputEmail3">
				</div>
			 </div>
			
			
				
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Mô tả sản phẩm</label>
				<div class="col-sm-10">
				  <textarea  name="mota_<?=$v?>" class="form-control  editor" id="mota_<?=$v?>" ><?=@$item['mota_'.$v]?></textarea>
				</div>
			</div>
		
			<div class="clearfix"></div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nội dung</label>
				
				
				<div class="col-sm-10">
				  <textarea  name="noidung_<?=$v?>" class="form-control editor" id="nd_<?=$v?>" ><?=@$item['noidung_'.$v]?></textarea>
				</div>
			</div>
			
			
			<div class="clearfix"></div>
			 </div>
		<?php } ?>
		<?php include _template."seo_tpl.php"?>
		<?php include _template."gallery_tpl.php"?>
	 
	  <div class="tab-pane  " id="size" >
		<?php 
			$list_size = array();
			if($item['id']){
				$sizes = getSizeByProductId($item['id']);
				
				foreach($sizes as $k=>$v){
					$list_size[] = $v['id_size'];
				}
			}
			$d->query("select * from #_product_size where hienthi = 1 order by stt desc");
			foreach($d->result_array() as $k=>$v){?>
				<div class="checkbox-inline">
				  <label>
					<input type="checkbox" value="1" <?=(in_array($v['id'],$list_size)) ? 'checked' : ''?> name="size[<?=$v['id']?>]">
						<?=$v['ten_vi']?>
				  </label>
				</div>
			<?php 	
				
				
			}

		?>		
		<div class="clearfix"></div>
	 </div><!-- end #size -->
	<div class="tab-pane  " id="color" >
		<?php 
			
			
			$list_color = array();
			$colors = array();
			if($item['id']){
				$colors = getColorByProductId($item['id']);
				$color_product = array();
				foreach($colors as $k=>$v){
					$list_color[] = $v['id_color'];
					$color_product[$v['id_color']] = $v;
				}
			}
		
		
		
			$d->query("select * from #_product_color where hienthi = 1 order by stt desc");
			foreach($d->result_array() as $k=>$v){?>
				<div class="checkbox">
				  <label>
					<?php 
						$checked = false;
						$is_check = false;
						if(in_array($v['id'],$list_color)){
							$checked = "checked";
							$is_check =true;
						}
					
					?>
					<input type="checkbox" value="1" <?=$checked?> name="color[<?=$v['id']?>]">
						<?=$v['ten_vi']?>
				  </label>
				  <div class="clearfix"></div>
				  <a class="btn btn-warning" data-toggle="collapse" href="#collapseExample<?=$v['id']?>" aria-expanded="false" aria-controls="collapseExample">
					Hình sản phẩm <?php 
						if($is_check){
							echo "(".count(json_decode($color_product[$v['id']]['image'])).")";
						}
					
					?>
			 	  </a>
				  <div class="collapse" id="collapseExample<?=$v['id']?>">
				  <div class="well">
					 <button id="add-image-option" class="add-image-option" data-id="<?=$v['id']?>" data-name="color<?=$v['id']?>">Thêm hình</button>
					 <div class="col-xs-12">
					 <div  style="margin-top:5px" id="gal-container-option-<?=$v['id']?>">
					 <?php
					 if($is_check){
						
						foreach(json_decode($color_product[$v['id']]['image']) as $k2=>$v2){
							$id = ChuoiNgauNhien(5);
							?>
							<div class="form-group form-group-sm">
							<div class="col-sm-6 input-group input-group-sm">
							  <span class="input-group-addon">
								<a onclick="viewFcb('<?=$id?>');return false;" class="view_fcb" id="" href="">Xem hình</a>
							  </span>
							  <input type="text" name="color<?=$v['id']?>[]" value="<?=$v2?>" class="form-control main-image" id="<?=$id?>">
							  <span class="input-group-btn">
								<button type="submit" data-for="<?=$id?>" class="show btn browser">Chọn</button>
							  </span>
							  <span class="input-group-btn"> 
								<button class=" btn btn-primary " onclick="$(this).parent().parent().parent().remove();">Xóa</button>
							  </span>
							</div>
							</div>
							
							<?php 
						}
					 }
					?>	
					</div><!-- end gal-container -->
				  </div>
				  <div class="clearfix"></div>
				</div>
				</div>
				</div>
			<?php 	
				
				
			}

		?>		
		<div class="clearfix"></div>
	 </div><!-- end #size -->
	
	
	</div><!-- end tab-content -->
	</div>	<!-- end col-xs-10 -->
	<div class="clearfix"></div>
	</div<!-- end col-xs-12 -->
	<div class="clearfix"></div>	
</div><!-- content-tab --><div class="clearfix"></div>		
</form>