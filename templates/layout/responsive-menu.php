<script src="assets/slidebars/slidebars.js" type="text/javascript"></script>
<link href="assets/slidebars/slidebars.css" rel="stylesheet" type="text/css" /> 
<link href="assets/slidebars/responsive-menu.css" rel="stylesheet" type="text/css" /> 
<div class="nav-responsive">
<!-- 
<div class="sb-toggle-left navbar-left">
	<div class="navicon-line"></div>
	<div class="navicon-line"></div>
	<div class="navicon-line"></div>
</div>
<a href="<?=$config_url?>"><img src="assets/img/logo.png" /></a>
</div>-->
<div class="sb-slidebar sb-style-push sb-left hidden-lg hidden-md hidden-sm">
	<nav>
		<ul class="sb-menu">
		<li class="sb-close"><a <?=(@$_GET['com']=='index' | @$_GET['com']=='') ? 'class="active"' : ''?> href="index.html" title="<?=_home?>"><?=_home?></a></li>
		<li class="sb-close"><a <?=(@$_GET['com']=='gioi-thieu') ? 'class="active"' : ''?> href="gioi-thieu.html" title="<?=_about?>"><?=_about?></a></li>
		<li class="sb-close"><a  href="tiec-cuoi.html" title="Tiệc cưới">TIỆC CƯỚI</a></li>
		<li class="sb-close"><a  href="hoi-nghi-va-su-kien.html" title="Hội nghị và sự kiện">HỘI NGHỊ VÀ SỰ KIỆN</a></li>
		<li class="sb-close"><a  href="ao-cuoi.html" title="Áo cưới">ÁO CƯỚI</a></li>
		<li class="sb-close"><a href="khach-san.html" title="Khách sạn">KHÁCH SẠN</a></li>	
		<li class="sb-close"><a href="album.html" title="Album">ALBUM</a></li>	
		<li class="sb-close"><a href="lien-he.html" title="Giới thiệu">LIÊN HỆ</a></li>
		<li class="sb-close">
			<div class="social" style="position:inherit">
			<?php
			
				$d->query("select * from #_social where hienthi = 1 order by stt desc");
				$rs_social = $d->result_array();
				
				foreach($rs_social as $k=>$v){
					echo "<a class='pull-left social-link'  href='".$v['link']."'><img src='"._upload_hinhanh_l.$v['photo']."' alt='".$v['ten']."' /></a>";
				}
			
			
			?>
			<div class="clearfix"></div>
			</div><!-- end social -->
		</li>
			
			<li class="sb-close"><div class="col-xs-12"><span class="sb-open-right">2014 COPYRIGHT © CHÂU LONG. ALL RIGHTS RESERVED</span></div></li>
			
			
		</ul>
	</nav>
</div>
<script>
			(function($) {
				$(document).ready(function() {
					$.slidebars();
					$('.sb-toggle-submenu').off('click').on('click', function() {
						$submenu = $(this).parent().children('.sb-submenu');
						$(this).add($submenu).toggleClass('sb-submenu-active'); // Toggle active class.
						
						if ($submenu.hasClass('sb-submenu-active')) {
							$submenu.slideDown(200);
						} else {
							$submenu.slideUp(200);
							
						}
						return false;
					});
				});
			}) (jQuery);
			
		</script>

