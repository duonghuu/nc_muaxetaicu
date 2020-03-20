<?php
	$d->query("select * from #_product_danhmuc where hienthi = 1 and noibat = 0  order by stt desc");
	$rs_product_danhmuc = $d->result_array();

?>
<div class="nav-bg">
    <div class="container">
	    <div class="main-nav">
				<a class="logo" href="index.html" title="<?=_home?>"><img src="assets/img/logo.png" alt="Logo" /></a>
	      <ul>
					<li class=" <?php if($template=='index'){ echo 'active';}?>"><a href="index.html" title="<?=_home?>">
					<?=_home?></a></li>
					<li class=" <?php if($com=='gioi-thieu'){ echo 'active';}?>"><a href="gioi-thieu.html" title="<?=_about?>"><?=_about?></a></li>
					<li <?php if($com=='tim-mua-oto'){ echo 'class="active"';}?>><a href="tim-mua-oto.html" title="Tìm mua ô tô">Tìm mua ôtô</a></li>
					<li <?php if($com=='ban-oto'){ echo 'class="active"';}?>><a href="ban-oto.html" title="Bán ô tô">Bán ôtô</a></li>
					<li <?php if($com=='tin-tuc'){ echo 'class="active"';}?>><a href="tin-tuc.html" title="<?=_news?>"><?=_news?></a></li>
					<li  class="<?php if($com=='tuyen-dung'){ echo 'active';}?>"> <a href="tuyen-dung.html" title="<?=_recruitment?>"><?=_recruitment?></a></li>
					<li  class="<?php if($com=='lien-he'){ echo 'active';}?>"> <a href="lien-he.html" title="<?=_contact?>"><?=_contact?></a></li>
	      </ul>
	      <button class="openBtn timkiem_icon" ><i class="glyphicon glyphicon-search"></i></button>
	      <div id="search">
	        <div id="form-search">
	        	<form method="get" action="index.php">
	        		<input type="text" placeholder="Nhập từ khóa tìm kiếm" name="keyword" required="">
	        		<button type="submit"><i class="glyphicon glyphicon-search"></i></button>
	        		<input type="hidden" name="com" value="search">
	        	</form> 
	        </div>
	      </div>
	    </div>
    </div>
  </div>