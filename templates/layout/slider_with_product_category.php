<script type="text/javascript" src="assets/iView-master/js/raphael-min.js"></script>
<script type="text/javascript" src="assets/iView-master/js/jquery.easing.js"></script>
<script type="text/javascript" src="assets/iView-master/js/iview.js"></script>

<link rel="stylesheet" href="assets/iView-master/css/skin1/style.css" type="text/css"/>
<link rel="stylesheet" href="assets/iView-master/css/iview.css" type="text/css"/>
<link rel="stylesheet" href="assets/css/slider_with_product_category.css" type="text/css"/>
<script>
			$(document).ready(function(){
				$('#iview').iView({
					pauseTime: 3000,
					pauseOnHover: true,
					directionNav: true,
					directionNavHide: false,
					directionNavHoverOpacity: 0,
					controlNav: false,
					
					timer: "360Bar",
					timerPadding: 3,
					timerColor: "#0F0"
				});

				})
				</script>
	<?php
	$d->reset();
	$d->query("select * from #_slider where hienthi = 1 order by stt,id desc");
	$slider = $d->result_array();
	?>
	<div class="container container-fixed" id="slider-category">
	
	
	<div class="left-product-category">
		<div class="title">Danh mục sản phẩm</div>
		<div class="content">
			<?php
				$d->query("select id,ten_$lang,tenkhongdau from #_product_danhmuc where hienthi = 1 and noibat = 1 order by stt desc");
				echo '<ul>';
					foreach($d->result_array() as $k=>$v){
						echo '<li><h2><a href="san-pham/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'"><span><img src="assets/img/list.png" /></span>'.$v['ten_'.$lang].'</a></h2></li>';
					}
				
				echo '</ul>';
			
			
			?>
		
		</div>
	</div>
	<div id="slider-wrapper">		
<div id="slider" >
		<div id="iview">
		<?php
			foreach($slider as $k=>$v){
				echo '<div data-iview:image="'._upload_hinhanh_l.$v['photo'].'" ><a class="" href="'.$v['link'].'" target="_blank" style="position:absolute;width:100%;height:100%;top:0;left:0;z-index:1234""></a></div>';			
			}		
		?>			
		</div>
	</div><!-- end  slider -->	

</div>
</div>
