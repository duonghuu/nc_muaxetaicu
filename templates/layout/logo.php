<div class="wrap-logo">
	<div class="xwrap">
<script src="assets/carousel/js/jquery.flexisel.js" type="text/javascript"></script>
<link href="assets/carousel/css/style.css" rel="stylesheet" type="text/css" />
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
		<script>
		$().ready(function(){
			 $("#flexiselDemo3").flexisel({
				visibleItems:7,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,            
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				
			});
		})
		</script>
		
		
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
		.wrap-logo .xwrap{border:1px solid red;border-left:0;border-right:0;padding-bottom:20px}
		</style>
		</div>
		</div>