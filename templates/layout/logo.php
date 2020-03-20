<div class="wrap-logo">
	<div class="xwrap">


<div class="clearfix"></div>
<section>
<div style="">
<?php
	$d->reset();
	$d->query("select * from #_doitac where hienthi = 1 order by stt,id desc");
	$logo = $d->result_array();

	
?>

<div class="container" id="logo-partne">

		<ul id="flexiselDemo3">
			<?php
			foreach($logo as $k=>$v){
				echo '<li><div><a target="_blank" title="'.$v['mota'].'" href="'.$v['mota'].'"><img src="'._upload_hinhanh_l.$v['photo'].'" /></a></div></li>';
			}
		
		
		?>
			
			
		</ul>    

		<div class="clearfix"></div>
		</div>
		</div>
		</section>
		
		
		<style>
		#logo-partne{
			position:relative;
			margin-top:20px;
		
		}
		#logo-partne .title{
		position: absolute;
z-index: 123;
width: 110px;
height: 26px;
line-height: 24px;
text-indent: 7px;
top: -13px;
left: 28px;
color: #fff;
background: #1997F7;
border-radius: 5px;
font-weight: bold;
font-size: 16px;
		}
		
		.wrap-logo{background:#fff;padding:20px 0}
		.wrap-logo .xwrap{padding-bottom:20px}
		</style>
		</div>
		</div>