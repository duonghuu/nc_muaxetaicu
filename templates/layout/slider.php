<script type="text/javascript" src="assets/iView-master/js/raphael-min.js"></script>
<script type="text/javascript" src="assets/iView-master/js/jquery.easing.js"></script>
<script type="text/javascript" src="assets/iView-master/js/iview.js"></script>

<link rel="stylesheet" href="assets/iView-master/css/skin4/style.css" type="text/css"/>
<link rel="stylesheet" href="assets/iView-master/css/iview.css" type="text/css"/>
<script>
			$(document).ready(function(){
				$('#iview').iView({
					pauseTime: 3000,
					pauseOnHover: true,
					directionNav: true,
					directionNavHide: false,
					directionNavHoverOpacity: 0,
					controlNav: false,
					nextLabel: "N�chste",
					previousLabel: "Vorherige",
					playLabel: "Spielen",
					pauseLabel: "Pause",
					timer: "360Bar",
					timerPadding: 3,
					timerColor: "#0F0"
				});

				})
				</script>


	<?php
	$d->reset();
	$d->query("select * from #_slider order by stt,id desc");
	$slider = $d->result_array();
	?>
	<div class="" id="slider-wrapper">
	<div class="container">
		<div class="left-slider">
<div id="slider" >
		<div id="iview">
		<?php
			foreach($slider as $k=>$v){
				echo '<div data-iview:image="'._upload_hinhanh_l.$v['photo'].'" ></div>';
			
			}
			
		?>
			
		</div>
</div><!-- end  slider -->
</div>
<div class="right-support">
	<div class="title"><h1>CÔNG TY TNHH TM <p>PHÚ GIA</p></div>
	<div class="clearfix"></div>
	<div class="content">
	<?php 
		$d->query("select mota_$lang from #_baiviet where id = 1");
		$r = $d->fetch_array();
		echo $r['mota_'.$lang];
		echo '<div class="clearfix"></div>';
		echo '<a href="gioi-thieu.html" title="Giới thiệu" class="view">Xem tiếp</a>';
	?>
	
	</div>
	
	

</div>
</div>

</div>

<div id="product-category-wrapper">
	<div class="container">
	<div class="title-root">LĨNH VỰC KINH DOANH</div>
	<div class="content">
		<ul class="ul-product-category">
			<?php 
				$d->query("select * from #_product_danhmuc where hienthi = 1 order by stt desc");
				foreach($d->result_array() as $k=>$v){
					echo '<li>';
						echo '<div class="pc-item">';
							echo '<a href="san-pham/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'"><img src="timthumb.php?src='.$config_url."/"._upload_sanpham_l.$v['photo'].'&w=375&h=190&zc=2" title="'.$v['ten_'.$lang].'" /></a>';
							echo '<div class="name"><a href="san-pham/'.$v['id'].'_'.$v['tenkhongdau'].'.html" title="'.$v['ten_'.$lang].'"><i class="glyphicon glyphicon-arrow-right"></i>&nbsp;'.$v['ten_'.$lang].'</a>';
						echo '</div>';
					echo '</li>';
					
				}
			?>
		
		</ul>
	
		<script>
			$().ready(function(){
				$(".ul-product-category").bxSlider({
					minSlides:3,
					maxSlides:3,
					moveSlides:1,
					slideWidth:375,
					slideMargin:10,
					auto:1,
					pager:0,
					controls:0
				})
			})
		</script>	
		
	</div>
	</div>
	


</div>